<?php

declare(strict_types=1);

namespace App\Enumerators;

enum Permissions: string
{
    case PAYER = 'payer';
    case RECEIVER = 'receiver';

    public static function isPayer(string $payer): bool
    {
        return self::PAYER->value === $payer;
    }
}
