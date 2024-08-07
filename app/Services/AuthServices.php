<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\AuthException;
use App\Facades\Authenticator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Random\RandomException;

class AuthServices
{
    /**
     * Creates a user token.
     *
     * @param array $attributes
     *
     * @return string
     *
     * @throws RandomException
     * @throws \Throwable
     */
    public function authenticate(array $attributes): string
    {
        return $this->createToken(attributes: $attributes);
    }

    /**
     * Checks the user exists for the attributes sent and generates an authentication token.
     *
     * @param array $attributes
     *
     * @return string
     *
     * @throws \Throwable
     */
    private function createToken(array $attributes): string
    {
        $attempt = Auth::attempt($attributes);
        $user = Auth::user();

        throw_unless(($attempt && $user instanceof User), AuthException::unauthorized());

        return Authenticator::generateToken(user: $user);
    }

    /**
     * Checks if the user is authenticated.
     *
     * @return array|null
     */
    public function verify(): ?array
    {
        return Authenticator::user()?->toArray();
    }
}
