<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo dữ liệu sách
        $truyen_tranh_co_tich = Category::where('slug', 'truyen-tranh-co-tich')->first();
        $truyen_tranh_co_tich_book_data = [
            [
                'category_id' => $truyen_tranh_co_tich->id,
                'publisher_id' => null,
                'promotion_id' => null,
                'title' => 'Cô bé quàng khăn đỏ',
                'slug' => 'co-be-quang-khan-do',
                'ISBN' => '9786042073227',
                'cover_image' => 'https://salt.tikicdn.com/cache/280x280/ts/product/7b/7e/7e/7b7e7e3b3b3b3b3b3b3b3b3b3b3b3b3.jpg',
                'thumbnail' => [
                    'https://salt.tikicdn.com/cache/280x280/ts/product/7b/7e/7e/7b7e7e3b3b3b3b3b3b3b3b3b3b3b3.jpg',
                    'https://salt.tikicdn.com/cache/280x280/ts/product/7b/7e/7e/7b7e7e3b3b3b3b3b3b3b3b3b3b3b3.jpg',
                ],
                'short_description' => 'Cô bé quàng khăn đỏ là câu chuyện về một cô bé mồ côi sống cùng bà mẹ kế và hai chị em. Một ngày nọ, mẹ kế gửi cô bé đến rừng để đưa thức ăn cho bà mẹ. Trên đường, cô bé gặp chó sói và bị đuổi đến nhà bà mẹ. Chó sói sau đó giả làm bà mẹ để lừa cô bé. Cô bé nhận ra điều đó và chạy thoát. Câu chuyện kết thúc với việc cô bé và bà mẹ được cứu khỏi chó sói.',
                'description' => 'Cô bé quàng khăn đỏ là câu chuyện về một cô bé mồ côi sống cùng bà mẹ kế và hai chị em. Một ngày nọ, mẹ kế gửi cô bé đến rừng để đưa thức ăn cho bà mẹ. Trên đường, cô bé gặp chó sói và bị đuổi đến nhà bà mẹ. Chó sói sau đó giả làm bà mẹ để lừa cô bé. Cô bé nhận ra điều đó và chạy thoát. Câu chuyện kết thúc với việc cô bé và bà mẹ được cứu khỏi chó sói.',
                'is_sale' => true,
                'price' => 50000,
                'discount' => 10,
                'pages' => 32,
                'weight' => 0.2,
                'height' => 0.2,
                'dimension_length' => 20,
                'dimension_width' => 20,
            ],
        ];

        $faker = Faker::create();
        $categoryIds = Category::pluck('id')->toArray();
        $publisherIds = Publisher::pluck('id')->toArray();

        //book in category_id 10

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
