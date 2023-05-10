<?php

namespace Database\Factories;

use App\Models\Offer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class OfferFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Offer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $offerTypes = ['percent', 'fixed', 'customized'];
        return [
            'name' => $this->faker->sentence(2),
            'description' => $this->faker->sentence(),
            'amount' => $this->faker->randomNumber(2),
            'type' => $this->faker->randomElement($offerTypes),
            'menu_item_id' => rand(1, 5),
            'start_at' => Carbon::now()->addDays(rand(1, 4))->toDateTimeString(),
            'end_at' => Carbon::now()->addDays(rand(5, 10))->toDateTimeString(),
        ];
    }
}