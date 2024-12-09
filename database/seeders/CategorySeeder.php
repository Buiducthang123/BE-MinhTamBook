<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Tạo danh mục cha
        $sachCategory = Category::create([
            'name' => 'Sách',
            'slug' => 'sach',
            'description' => '<p>Tất cả các loại sách.</p>',
            'parent_id' => null,
        ]);

        $sachDienTuCategory = Category::create([
            'name' => 'Sách điện tử',
            'avatar' => 'https://salt.tikicdn.com/ts/category/cc/66/3d/4e4f1b8b1e772fe9e09611c6bec98746.png',
            'slug' => 'sach-dien-tu',
            'description' => '<p>Phiên bản kỹ thuật số của sách.</p>',
            'parent_id' => null,
        ]);

        // Tạo danh mục con
        Category::create([
            'name' => 'Tiểu thuyết',
            'avatar'=>'https://salt.tikicdn.com/ts/category/53/0f/bc/f6e936554ec845b45af8f94cbd4f1569.png',
            'slug' => 'tieu-thuyet',
            'description' => '<p>Sách tiểu thuyết.</p>',
            'parent_id' => $sachCategory->id,
        ]);

        Category::create([
            'name' => 'Phi hư cấu',
            'avatar'=>'https://salt.tikicdn.com/ts/category/45/ab/0f/cffe9f60a7b37e0f87a9c50c4478aed9.png',
            'slug' => 'phi-hu-cau',
            'description' => '<p>Sách phi hư cấu.</p>',
            'parent_id' => $sachCategory->id,
        ]);

        Category::create([
            'name' => 'Khoa học',
            'slug' => 'khoa-hoc',
            'description' => '<p>Sách khoa học.</p>',
            'parent_id' => $sachDienTuCategory->id,
        ]);
    }
}
