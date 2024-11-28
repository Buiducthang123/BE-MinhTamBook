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
        Schema::create('book_editions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
            $table->string('ISBN', 13)->unique()->comment('Mã ISBN');
            $table->enum('language', [1,2,3])->nullable()->comment('Ngôn ngữ');
            $table->enum('format', [1,2,3])->nullable()->comment('Định dạng');
            $table->date('published_date')->nullable()->comment('Ngày xuất bản');
            $table->text('short_description')->nullable()->comment('Mô tả ngắn');
            $table->decimal('entry_price',10,2)->nullable()->comment('Giá nhập');
            $table->mediumInteger('entry_quantity')->nullable()->comment('Số lượng nhập');
            $table->mediumInteger('stock_quantity')->nullable()->comment('Số lượng tồn');
            $table->mediumInteger('sold_quantity')->nullable()->comment('Số lượng đã bán');
            $table->string('cover_image', 255)->nullable()->comment('Ảnh bìa');
            $table->json('thumbnails')->nullable()->comment('Ảnh minh họa');
            $table->smallInteger('pages')->nullable()->comment('Số trang');
            $table->float('weight')->nullable()->comment('Trọng lượng');
            $table->float('dimension_length')->nullable()->comment('Chiều dài');
            $table->float('dimension_width')->nullable()->comment('Chiều rộng');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_editions');
    }
};
