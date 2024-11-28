<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        Publisher::create([
            'name' => 'BamBoo Book',
            'avatar' => 'https://m.media-amazon.com/images/I/51O1GMHm1nL.png',
            'description' => $faker->text(200),
        ]);

        Publisher::create([
            'name' => 'Kim Dong',
            'avatar' => 'https://tinhocnews.com/wp-content/uploads/2024/06/logo-nha-xuat-ban-kim-dong-vector-7.jpg',
            'description' => $faker->text(200),
        ]);

        Publisher::create([
            'name' => 'J97 Book',
            'avatar' => 'https://ss-images.saostar.vn/wp700/pc/1600308790322/119589262_177644733858942_8580638557651264608_o(1).jpg',
            'description' => $faker->text(200),
        ]);

    }
}
