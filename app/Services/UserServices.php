<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repository\UserRepository;

class UserServices
{
    public function __construct(protected UserRepository $userRepository)
    {
    }

    /**
     * Create user.
     *
     * @param array $attributes
     *
     * @return User
     *
     * @throws \Throwable
     */
    public function store(array $attributes): User
    {
        return $this->userRepository
            ->create($attributes)
            ->syncRole($attributes['role'] ?? '')
            ->syncWallet();
    }
}
