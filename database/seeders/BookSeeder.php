<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $categoryIds = Category::pluck('id')->toArray();
        $publisherIds = Publisher::pluck('id')->toArray();

        for ($i = 0; $i < 100; $i++) {
            Book::create([
                'category_id' => $faker->randomElement($categoryIds),
                'publisher_id' => $faker->randomElement($publisherIds),
                'promotion_id' => null, // Assuming no promotions for now
                'title' => $faker->sentence(3),
                'slug' => $faker->slug,
                'ISBN' => $faker->unique()->isbn13,
                'cover_image' => $faker->imageUrl(640, 480, 'books', true),
                // 'thumbnail' => json_encode([$faker->imageUrl(640, 480, 'books', true), $faker->imageUrl(640, 480, 'books', true)]),
                'thumbnail' => [],
                'short_description' => $faker->sentence,
                'description' => $faker->paragraph,
                'is_sale' => $faker->boolean,
                'price' => $faker->numberBetween(100000, 1000000),
                'discount' => $faker->randomFloat(2, 0, 30),
                'pages' => $faker->numberBetween(100, 500),
                'weight' => $faker->randomFloat(2, 0.5, 2),
                'height' => $faker->randomFloat(2, 2, 5),
                'dimension_length' => $faker->randomFloat(2, 10, 30),
                'dimension_width' => $faker->randomFloat(2, 10, 30),
            ]);
        }
    }
}
