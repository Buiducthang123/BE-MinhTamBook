<?php

use App\Enums\AccountStatus;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
            $table->string('full_name',255); // Họ và tên
            $table->string('email')->unique(); // Email
            // $table->string('phone_number',11)->unique()->nullable(); // Số điện thoại
            $table->string('company_name',255)->nullable(); // Tên công ty
            $table->string('company_address')->nullable(); // Địa chỉ công ty
            $table->string('company_phone_number',11)->nullable(); // Số điện thoại công ty
            $table->string('company_tax_code',15)->nullable(); // Mã số thuế công ty
            $table->string('contact_person_name',255)->nullable(); // Tên người liên hệ công ty
            $table->string('representative_id_card',12)->nullable(); // Số CMND người đại diện
            $table->string('representative_id_card_date',10)->nullable(); // Ngày cấp CMND người đại diện
            $table->string('contact_person_position',255)->nullable(); // Chức vụ người liên hệ
            $table->enum('status', AccountStatus::getValues())->default(AccountStatus::NOT_ACTIVE); // Trạng thái
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
