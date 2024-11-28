<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            ]);
        }
    }
}
