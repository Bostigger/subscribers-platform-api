<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Website;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Website::all()->each(function ($website) {
            Post::factory(3)->create(['website_id' => $website->id]);
        });
    }
}
