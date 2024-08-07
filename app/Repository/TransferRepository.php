<?php

declare(strict_types=1);

namespace App\Repository;

use App\Connections\AuthorizerConnection;
use App\Exceptions\TransferException;
use App\Models\Wallet;
use App\Reads\Interfaces\WireTransferInterface;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TransferRepository
{
    public function __construct(
        private WalletRepository $walletRepository,
    ) {
    }

    /**
     * Performs a transfer, simplified payment validating the payer's authorization and executing the deal.
     *
     * @param WireTransferInterface $wireTransfer
     *
     * @return Collection<Wallet|empty>
     *
     * @throws RequestException
     * @throws \Throwable
     */
    public function transfer(WireTransferInterface $wireTransfer): Collection
    {
        throw_unless(
            $this->authorization(),
            TransferException::hasNoAuthorize()
        );

        DB::beginTransaction();

        try {
            $wallets = $this->walletRepository->deal(wireTransfer: $wireTransfer);
        } catch (\Exception $exception) {
            DB::rollBack();

            return collect([]);
        }

        DB::commit();

        return $wallets;
    }

    /**
     * External authorizer.
     *
     * @return bool
     *
     * @throws RequestException
     */
    public function authorization(): bool
    {
        $authorize = AuthorizerConnection::authorize()->object();

        return $authorize?->data->authorization;
    }

    /**
     * Notifies a successful simplified payment transfer.
     *
     * @return Response
     *
     * @throws RequestException
     */
    public function notify(): Response
    {
        return AuthorizerConnection::notify();
    }
}
