<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enumerators\Roles;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Roles::cases() as $case) {
            Role::firstOrCreate([
                'slug' => $case->value,
                'name' => Str::headline($case->value),
            ]);
        }
    }
}
