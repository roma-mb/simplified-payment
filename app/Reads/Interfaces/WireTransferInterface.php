<?php

declare(strict_types=1);

namespace App\Reads\Interfaces;

interface WireTransferInterface
{
    public function value(): float;
    public function payer(): int;
    public function payee(): int;
}
