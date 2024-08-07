<?php

declare(strict_types=1);

namespace App\Services\Patterns;

use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Random\RandomException;

class AuthenticatorFacade
{
    /**
     * Generates a token.
     *
     * @param User $user
     *
     * @return string
     *
     * @throws RandomException
     */
    public function generateToken(User $user): string
    {
        $now = Carbon::now();
        $secretKey  = env('JWT_KEY', '');
        $servername  = env('APP_NAME', '');

        $data = [
            'iat'  => $now->getTimestamp(),
            'jti'  => base64_encode(random_bytes(16)),
            'iss'  => $servername,
            'nbf'  => $now->getTimestamp(),
            'exp'  => $now->addMinutes(60)->getTimestamp(),
            'data' => [
                'userId' => $user->id,
            ],
        ];

        return JWT::encode(
            $data,
            $secretKey,
            'HS512'
        );
    }

    /**
     * Returns an authenticated user.
     *
     * @return User|null
     */
    public function user(): ?User
    {
        $token = $this->decodeRawJWT();

        return Cache::remember($token->data->userId, 3600, function () use ($token) {
            return User::find($token->data->userId);
        });
    }

    /**
     * Decodes a token sent on the http authorization server in the request.
     *
     * @return \stdClass
     */
    private function decodeRawJWT(): \stdClass
    {
        $secretKey  = env('JWT_KEY', '');
        preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'] ?? '', $matches);

        return JWT::decode($matches[1] ?? '', new Key($secretKey, 'HS512'));
    }
}
