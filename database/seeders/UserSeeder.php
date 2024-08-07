<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rolesCount = Role::all()->count();

        if (($rolesCount > 0) && User::all()->isEmpty()) {
            User::factory($rolesCount)->create();
        }
    }
}
