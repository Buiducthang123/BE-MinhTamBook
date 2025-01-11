<?php

namespace Database\Seeders;

use App\Enums\BookTransactionStatus;
use App\Enums\BookTransactionType;
use App\Models\Book;
use App\Models\BookTransaction;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class BookTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $bookIds = Book::pluck('id')->toArray();

        if (count($bookIds) > 0) {
            for ($i = 0; $i < 20; $i++) {
                $bookId = $faker->randomElement($bookIds);
                $type = $faker->randomElement(BookTransactionType::getValues());
                // $status = $faker->randomElement(BookTransactionStatus::getValues());
                $status = BookTransactionStatus::SUCCESS;
                $quantity = $faker->numberBetween(1, 10);
                $price = $faker->numberBetween(10000, 100000);
                $date = Carbon::create('2000', '01', '01');
                $note = $faker->sentence;

                BookTransaction::create([
                    'book_id' => $bookId,
                    'type' => $type,
                    'status' => $status,
                    'quantity' => $quantity,
                    'price' => $price,
                    'date' => $date,
                    'note' => $note,
                ]);
            }
        }
    }
}
