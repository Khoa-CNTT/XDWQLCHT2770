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
        Schema::create('chi_tiet_dat_phongs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_dat_phong')->constrained('bookings')->onDelete('cascade');
            $table->foreignId('id_phong')->constrained('phongs')->onDelete('cascade');
            $table->date('ngay_nhan_phong');
            $table->date('ngay_tra_phong');
            $table->integer('gia');
            $table->integer('ghi_chu')->nullable();
            $table->date('check_out_thuc_te');
            $table->integer('tinh_trang')->default(0);//0:da dat, 1:da nhan, 2:da tra, 3:don dep, 4:hoan thanh
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_dat_phongs');
    }
};
