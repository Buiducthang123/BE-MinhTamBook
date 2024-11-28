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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('shipping_address_id')->constrained('shipping_addresses')->onDelete('cascade');
            $table->decimal('total_amount', 10, 2)->comment('Tổng tiền');
            $table->enum('payment_method', ['cod', 'bank_transfer'])->comment('Phương thức thanh toán');
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->comment('Trạng thái');
            $table->decimal('shipping_fee', 10, 2)->default(0)->comment('Phí vận chuyển');
            $table->string('voucher_code', 255)->nullable()->comment('Mã giảm giá');
            $table->decimal('discount_amount', 10, 2)->default(0)->comment('Số tiền giảm giá');
            $table->decimal('amount', 15, 2)->comment('Số tiền cần thanh toán');
            $table->date('payment_date')->nullable()->comment('Ngày thanh toán');
            $table->unsignedBigInteger('transaction_id')->nullable()->comment('Mã giao dịch');
            $table->unsignedBigInteger('ref_id')->nullable()->comment('Mã giao dịch hoàn');
            $table->text('note')->nullable()->comment('Ghi chú');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
