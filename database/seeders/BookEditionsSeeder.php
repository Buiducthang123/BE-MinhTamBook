<?php

namespace Database\Seeders;

use App\Enums\Book\Format;
use App\Enums\Book\Language;
use App\Models\Book;
use App\Models\BookEditions;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BookEditionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $bookIds = Book::pluck('id')->toArray();

        for ($i = 0; $i < 100; $i++) {
            BookEditions::create([
                'book_id' => $faker->randomElement($bookIds),
                'ISBN' => $faker->unique()->isbn13,
                'language' => $faker->randomElement(Language::getValues()),
                'format' => $faker->randomElement(Format::getValues()),
                'published_date' => $faker->date(),
                'short_description' => $faker->text(200),
                'entry_price' => $faker->randomFloat(2, 10, 100),
                'entry_quantity' => $faker->numberBetween(1, 100),
                'stock_quantity' => $faker->numberBetween(1, 100),
                'sold_quantity' => $faker->numberBetween(1, 100),
                'cover_image' => $faker->imageUrl(640, 480, 'books', true),
                'thumbnails' => json_encode([$faker->imageUrl(640, 480, 'books', true), $faker->imageUrl(640, 480, 'books', true)]),
                'pages' => $faker->numberBetween(50, 1000),
                'weight' => $faker->randomFloat(2, 0.1, 2),
                'dimension_length' => $faker->randomFloat(2, 10, 30),
                'dimension_width' => $faker->randomFloat(2, 10, 30),
            ]);
        }
    }
}
