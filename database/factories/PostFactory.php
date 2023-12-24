<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Website;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'website_id' => Website::factory(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];
    }
}
