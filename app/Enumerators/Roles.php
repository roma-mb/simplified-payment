<?php

declare(strict_types=1);

namespace App\Enumerators;

enum Roles: string
{
    case SHOP_OWNER = 'shop-owner';
    case CUSTOMER = 'customer';

    public static function isShopOwner(string $role): bool
    {
        return self::SHOP_OWNER->value === $role;
    }
}
