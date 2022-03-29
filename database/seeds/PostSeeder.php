<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

use Faker\Generator as Faker;

use App\Models\Post;
use App\Models\Category;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        // Recupero gli id delle categories
        $category_ids = Category::pluck('id')->toArray();

        for ($i = 0; $i < 25; $i++) {
            $post = new Post();
            $post->title = $faker->sentence(3);
            $post->content = $faker->paragraph();
            $post->img = $faker->imageUrl(640, 480, 'animals', true);
            $post->slug = Str::slug($post->title, '-');
            // ID CATEGORIES
            $post->category_id = Arr::random($category_ids);
            $post->save();
        }
    }
}
