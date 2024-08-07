<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Role;

class RoleRepository
{
    /**
     * Find a role by attribute.
     *
     * @param string $attribute
     * @param mixed $value
     *
     * @return mixed
     */
    public function findBy(string $attribute, mixed $value): mixed
    {
        return Role::where($attribute, $value)->first();
    }
}
