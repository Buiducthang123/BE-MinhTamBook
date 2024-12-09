<?php

use App\Enums\BookTransactionStatus;
use App\Enums\BookTransactionType;
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
        Schema::create('book_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('type', BookTransactionType::getValues())->comment('Loại giao dịch');
            $table->integer('quantity')->comment('Số lượng');
            $table->unsignedBigInteger('price')->comment('Giá');
            $table->text('note')->nullable()->comment('Ghi chú');
            $table->date('date')->comment('Ngày thực hiện');
            $table->enum('status', BookTransactionStatus::getValues())->comment('Trạng thái');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_transactions');
    }
};
