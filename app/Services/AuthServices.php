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
     * @throws \Throwable
     * @throws RandomException
     */
    public function authenticate(array $attributes): string
    {
        return $this->createToken(attributes: $attributes);
    }

    /**
     * @throws \Throwable
     * @throws RandomException
     */
    private function createToken(array $attributes): string
    {
        $attempt = Auth::attempt($attributes);
        $user = Auth::user();

        throw_unless(($attempt && $user instanceof User), AuthException::unauthorized());

        return Authenticator::generateToken(user: $user);
    }

    public function verify(): ?array
    {
        return Authenticator::user()?->toArray();
    }
}
