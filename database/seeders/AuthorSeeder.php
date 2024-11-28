<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        Author::create([
            'name' => 'Trịnh Trần Phương Tuấn',
            'avatar' => 'https://images2.thanhnien.vn/zoom/686_429/Uploaded/thanhlongn/2020_02_18/86289201_870689476727516_8388718750026694656_n_CYDJ.jpg',
            'description' => $faker->text(200),
        ]);

        Author::create([
            'name' => 'Hàn TÍn',
            'avatar' => 'https://danviet.mediacdn.vn/zoom/700_438/296231569849192448/2023/7/22/ang-quyet-diet-tru-bang-duoc-chien-than-han-tin-han-tin-3-1532249117-width660height345-1690040022282-1690040022469136286787-0-108-345-660-crop-16900404267512097823263.jpg',
            'description' => $faker->text(200),
        ]);

        Author::create([
            'name' => 'Dương Quá',
            'avatar' => 'https://tintuc-divineshop.cdn.vccloud.vn/wp-content/uploads/2022/08/than-dieu-dai-hiep-top-6-cao-thu-out-trinh-duong-qua-gom-nhung-ai_6305f807422e8.jpeg',
            'description' => $faker->text(200),
        ]);

    }
}
