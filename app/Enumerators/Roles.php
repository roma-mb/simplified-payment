<?php

declare(strict_types=1);

namespace App\Enumerators;

enum Roles: string
{
    case SHOP_OWNER = 'shop-owner';
    case CUSTOMER = 'customer';

    /**
     * Check if the role is a shop owner.
     *
     * @param string $role
     *
     * @return bool
     */
    public static function isShopOwner(string $role): bool
    {
        return self::SHOP_OWNER->value === $role;
    }
}
