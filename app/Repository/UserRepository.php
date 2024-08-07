<?php

declare(strict_types=1);

namespace App\Repository;

use App\Exceptions\UserException;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class UserRepository
{
    /**
     * Find permission by user.
     *
     * @param User $user
     * @param string $permission
     *
     * @return Collection
     */
    public function findPermission(User $user, string $permission): Collection
    {
        return $user->permissions()->whereHas(
            'permissions',
            fn (Builder $builder) => $builder->where('slug', $permission)
        )->get();
    }

    public function findWallet(User $user): Wallet
    {
        return $user->wallet;
    }

    /**
     * Find a user.
     *
     * @param int $id
     *
     * @return User
     */
    public function find(int $id): User
    {
        return User::find($id);
    }

    /**
     * Create a user.
     *
     * @param array $attributes
     *
     * @return User
     *
     * @throws \Throwable
     */
    public function create(array $attributes): User
    {
        $user = User::create($attributes);

        throw_unless($user instanceof User, UserException::userNotCreated());

        return $user;
    }
}
