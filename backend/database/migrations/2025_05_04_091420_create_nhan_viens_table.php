<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nhan_viens', function (Blueprint $table) {
            $table->id();
            $table->string('ho_ten')->nullable();
            $table->string('so_dien_thoai');
            $table->date('ngay_sinh')->nullable();
            $table->integer('gioi_tinh')->default(1); // 1: nam, 0: nữ; 3: khác
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('is_block')->default(0); // 0: chưa bị khóa, 1: đã bị khóa
            $table->string('id_chuc_vu');
            $table->integer('is_master')->default(0);//0: nhân viên, 1: quản lý
            $table->string('id_homestay')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhan_viens');
    }
};
