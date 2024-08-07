<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Permission>
 */
class WalletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $balance = $this->faker->randomFloat(2, 150.00, 500.00);

        return [
            'balance' => $balance,
            'limit' => $balance * 2,
            'user_id' => 0,
        ];
    }
}
