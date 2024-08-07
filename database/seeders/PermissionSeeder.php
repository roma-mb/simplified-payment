<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enumerators\Permissions;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Permissions::cases() as $case) {
            Permission::firstOrCreate([
                'slug' => $case->value,
                'name' => Str::headline($case->value),
            ]);
        }
    }
}
