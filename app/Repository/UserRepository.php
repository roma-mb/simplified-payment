<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserRepository
{
    public function findPermission(User $user, string $permission)
    {
        return $user->permissions()->whereHas(
            'permissions',
            fn (Builder $builder) => $builder->where('slug', $permission)
        )->get();
    }

    public function findBalance(User $user)
    {
    }
}
