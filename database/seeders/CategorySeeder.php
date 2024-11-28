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
            'description' => 'Tất cả các loại sách.',
            'parent_id' => null,
        ]);

        $sachDienTuCategory = Category::create([
            'name' => 'Sách điện tử',
            'slug' => 'sach-dien-tu',
            'description' => 'Phiên bản kỹ thuật số của sách.',
            'parent_id' => null,
        ]);

        // Tạo danh mục con
        Category::create([
            'name' => 'Tiểu thuyết',
            'slug' => 'tieu-thuyet',
            'description' => 'Sách tiểu thuyết.',
            'parent_id' => $sachCategory->id,
        ]);

        Category::create([
            'name' => 'Phi hư cấu',
            'slug' => 'phi-hu-cau',
            'description' => 'Sách phi hư cấu.',
            'parent_id' => $sachCategory->id,
        ]);

        Category::create([
            'name' => 'Khoa học',
            'slug' => 'khoa-hoc',
            'description' => 'Sách khoa học.',
            'parent_id' => $sachDienTuCategory->id,
        ]);
    }
}
