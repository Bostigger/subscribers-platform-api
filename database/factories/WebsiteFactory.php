<?php

namespace Database\Factories;

use App\Models\Website;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Website>
 */
class WebsiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Website::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'url' => $this->faker->url,
        ];
    }
}
