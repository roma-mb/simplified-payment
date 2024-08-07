<?php

declare(strict_types=1);

namespace App\Services;

use App\Enumerators\Permissions;
use App\Exceptions\TransferException;
use App\Jobs\ProcessTransfer;
use App\Models\Wallet;
use App\Policies\UserPolicy;
use App\Reads\WireTransfer;
use App\Repository\TransferRepository;
use Illuminate\Http\Client\RequestException;

class TransferServices
{
    public function __construct(
        protected TransferRepository $transferRepository
    ) {
    }

    /**
     * Performs a transfer, checking permission policies.
     *
     * @param array $attributes
     *
     * @return Wallet
     *
     * @throws RequestException
     * @throws \Throwable
     */
    public function transfer(array $attributes): Wallet
    {
        $wireTransfer = new WireTransfer($attributes);

        (new UserPolicy())
            ->hasPermission(permission: Permissions::PAYER->value)
            ->hasBalance(value: $wireTransfer->value());

        $transfer = $this->transferRepository->transfer(wireTransfer: $wireTransfer);
        $wallet = $transfer->get('payee');

        throw_unless(
            ($wallet instanceof Wallet),
            TransferException::walletNotFound(wallet: 'Payee wallet')
        );

        ProcessTransfer::dispatch(wallet: $wallet);

        return $transfer->get('payer');
    }
}
