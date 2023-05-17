<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $status = [
            'pending',
            'received',
            'ready to be prepared', 'preparing',
            'ready to be delivered', 'delivering',
            'completed',
            'canceled',
        ];
        return [
            'user_id' => rand(1, 4),
            'order_address_id' => rand(1, 5),
            'status' => fake()->randomElement($status),
        ];
    }
}
