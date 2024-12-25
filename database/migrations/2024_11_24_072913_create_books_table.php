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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('publisher_id')->constrained('publishers')->onDelete('cascade');
            $table->foreignId('promotion_id')->nullable()->constrained('promotions')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->nullable()->unique()->comment('Slug');
            $table->string('ISBN', 13)->unique()->comment('Mã ISBN');
            $table->string('cover_image', 255)->nullable()->comment('Ảnh bìa');
            $table->json('thumbnail')->nullable()->comment('Ảnh minh họa');
            $table->text('short_description')->nullable()->comment('Mô tả ngắn');
            $table->longText('description')->nullable()->comment('Mô tả ngắn');
            $table->boolean('is_sale')->default(false)->comment('Có bán không');
            $table->decimal(('price'), 10, 2)->nullable()->comment('Giá bán ra');
            $table->decimal('discount', 5, 2)->nullable()->comment('Giảm giá');
            $table->mediumInteger('pages')->nullable()->comment('Số trang');
            $table->float('weight')->comment('Trọng lượng');
            $table->float('height')->comment('Chiều cao');
            $table->float('dimension_length')->comment('Chiều dài');
            $table->float('dimension_width')->comment('Chiều rộng');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
