<?php

declare(strict_types=1);

namespace App\Policies;

use App\Exceptions\PolicyException;
use App\Facades\Authenticator;
use App\Models\User;
use App\Repository\UserRepository;

class UserPolicy
{
    private UserRepository $userRepository;

    private User $user;

    public function __construct(?User $user = null)
    {
        $this->user = ($user instanceof User) ? $user : Authenticator::user();
        $this->userRepository = new UserRepository();
    }

    /**
     * @throws \Throwable
     */
    public function hasPermission(string $permission): UserPolicy
    {
        $hasPermission = $this->userRepository->findPermission($this->user, $permission)->isNotEmpty();

        throw_unless(
            $hasPermission,
            PolicyException::hasNoPermission(action: 'transfer')
        );

        return $this;
    }

    /**
     * @throws \Throwable
     */
    public function hasBalance(float $value): UserPolicy
    {
        $wallet = $this->userRepository->findWallet(user: $this->user);

        throw_if(
            ($wallet->balance - $value) < 0.0,
            PolicyException::hasNoPermission(action: 'transfer, no balance')
        );

        return $this;
    }
}
