<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'number_of_stars' => rand(1,5),
            'body' => fake()->sentence(),
            'user_id' => rand(1,5),
            'menu_item_id' => rand(1,5),
            'created_at' => Carbon::now()->subDays(rand(1,29))->subMonth(rand(1,12))->subYear(rand(0,2)),
        ];
    }
}
