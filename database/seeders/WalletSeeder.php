<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::all()->each(
            fn (User $user) => Wallet::factory()->create(['user_id' => $user])
        );
    }
}
