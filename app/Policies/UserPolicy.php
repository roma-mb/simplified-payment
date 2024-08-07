<?php

namespace App\Policies;

use App\Exceptions\PermissionException;

use App\Models\User;
use App\Repository\UserRepository;

readonly class UserPolicy
{
    public function __construct(
        private User $user,
        private UserRepository $userRepository = new UserRepository(),
    ){}

    /**
     * @throws \Throwable
     */
    public function hasPermission(string $permission): UserPolicy
    {
        $hasPermission = $this->userRepository->findPermission($this->user, $permission)->isNotEmpty();

        throw_unless($hasPermission, PermissionException::hasNoPermission(action: 'transfer'));

        return $this;
    }

    public function hasBalance(float $value): UserPolicy
    {
        $this->userRepository->findBalance(user: $this->user);

        return $this;
    }
}
