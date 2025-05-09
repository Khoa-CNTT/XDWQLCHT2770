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
        Schema::create('hoa_dons', function (Blueprint $table) {
            $table->id();
            $table->string('ma_hoa_don')->unique();
            $table->string('id_khach_hang');
            $table->string('id_homestay');
            $table->date('ngay_tao');
            $table->text('ghi_chu')->nullable();
            $table->integer('trang_thai')->default(0); // 0: chưa thanh toán, 1: đã thanh toán
            $table->integer('tong_tien');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoa_dons');
    }
};
