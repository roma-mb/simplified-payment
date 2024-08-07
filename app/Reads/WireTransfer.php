<?php

declare(strict_types=1);

namespace App\Reads;

use App\Reads\Interfaces\WireTransferInterface;

readonly class WireTransfer implements WireTransferInterface
{
    public function __construct(
        private array $attributes
    ){}

    public function value(): float
    {
        return $this->attributes['value'] ?? 0.0;
    }

    public function payer(): int
    {
        return $this->attributes['payer'] ?? 0;
    }

    public function payee(): int
    {
        return $this->attributes['payee'] ?? 0;
    }
}
