<?php

namespace Database\Factories;

use App\Models\Offer;
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
        ];
    }
}