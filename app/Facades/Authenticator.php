<?php

declare(strict_types=1);

namespace App\Facades;

use App\Services\Patterns\AuthenticatorFacade;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Facade;

/***
 * @method static generateToken(Authenticatable|null $user): string
 * @method static decodeRawJWT(): ?array
 * @method static user(): ?User
 */
class Authenticator extends Facade
{
    /**
     * Get facade.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return AuthenticatorFacade::class;
    }
}
