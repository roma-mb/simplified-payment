<?php

declare(strict_types=1);

namespace App\Repository;

use App\Exceptions\TransferException;
use App\Models\Wallet;
use App\Reads\Interfaces\WireTransferInterface;
use Illuminate\Support\Collection;

class WalletRepository
{
    public function __construct(
        protected UserRepository $userRepository
    ) {
    }

    /**
     * Recover the wallets and persist with the transfer based on the deal.
     *
     * @param WireTransferInterface $wireTransfer
     *
     * @return Collection<Wallet|empty>
     *
     * @throws \Throwable
     */
    public function deal(WireTransferInterface $wireTransfer): Collection
    {
        $payerWallet = $this->findBy(attribute: 'user_id', value: $wireTransfer->payer());
        $payeeWallet = $this->findBy(attribute: 'user_id', value: $wireTransfer->payee());

        throw_unless(
            $payerWallet->exists && $payeeWallet->exists,
            TransferException::usersNotFound()
        );

        $payerWallet->balance = $wireTransfer->debit(value: $payerWallet->balance);
        $payerWallet->save();

        $payeeWallet->balance = $wireTransfer->credit(value: $payeeWallet->balance);
        $payeeWallet->save();

        return collect([
            'payer' => $payerWallet,
            'payee' => $payeeWallet,
        ]);
    }

    /**
     * Find a wallet by attribute.
     *
     * @param string $attribute
     * @param mixed $value
     *
     * @return mixed
     */
    public function findBy(string $attribute, mixed $value): mixed
    {
        return Wallet::where($attribute, $value)->first();
    }
}
