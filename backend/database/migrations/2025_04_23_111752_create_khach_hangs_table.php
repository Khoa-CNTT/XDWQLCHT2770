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
        Schema::create('khach_hangs', function (Blueprint $table) {
            $table->id();
            $table->string('ho_ten');
            $table->string('email')->unique();
            $table->string('so_dien_thoai')->unique();
            $table->string('ngay_sinh');
            $table->integer('gioi_tinh');// 1: Nam, 2: Nữ, 0: Khác
            $table->string('avatar')->nullable();
            $table->string('mat_khau');
            $table->string('hash_active')->nullable();
            $table->string('hash_reset')->nullable();
            $table->integer('is_block')->default(0);
            $table->integer('is_active')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khach_hangs');
    }
};
