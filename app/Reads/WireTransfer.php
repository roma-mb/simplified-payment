<?php

declare(strict_types=1);

namespace App\Reads;

use App\Reads\Interfaces\WireTransferInterface;

readonly class WireTransfer implements WireTransferInterface
{
    public function __construct(
        private array $attributes
    ) {
    }

    /**
     * Get transfer value.
     *
     * @return float
     */
    public function value(): float
    {
        return $this->attributes['value'] ?? 0.0;
    }

    /**
     * Get payer.
     *
     * @return int
     */
    public function payer(): int
    {
        return $this->attributes['payer'] ?? 0;
    }

    /**
     * Get payee.
     *
     * @return int
     */
    public function payee(): int
    {
        return $this->attributes['payee'] ?? 0;
    }

    /**
     * Get a debit value.
     *
     * @param float $value
     *
     * @return float
     */
    public function debit(float $value): float
    {
        return $value - $this->value();
    }

    /**
     * get a credit value.
     *
     * @param float $value
     *
     * @return float
     */
    public function credit(float $value): float
    {
        return $value + $this->value();
    }
}
