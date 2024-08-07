<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enumerators\Permissions;
use App\Enumerators\Roles;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::all()->each(fn (Role $role) => Permission::all()->each(
            fn (Permission $permission) => Roles::isShopOwner(role: $role->slug) && Permissions::isPayer(payer: $permission->slug)
                ? []
                : $permission->roles()->syncWithoutDetaching($role)
        ));
    }
}
