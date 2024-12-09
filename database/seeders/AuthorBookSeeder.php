<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\AuthorBook;
use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class AuthorBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $authorIds = Author::pluck('id')->toArray();
        $bookIds = Book::pluck('id')->toArray();

        for($i = 0; $i < 100; $i++){
            AuthorBook::create([
                'author_id' => $faker->randomElement($authorIds),
                'book_id' => $faker->randomElement($bookIds),
            ]);
        }
    }
}
