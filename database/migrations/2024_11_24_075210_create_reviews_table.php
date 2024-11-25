<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId(('user_id'))->constrained('users')->onDelete('cascade');
            $table->foreignId('book_edition_id')->constrained('book_editions')->onDelete('cascade');
            $table->enum('rating', [1, 2, 3, 4, 5])->comment('Đánh giá');
            $table->text('comment')->nullable()->comment('Bình luận');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
