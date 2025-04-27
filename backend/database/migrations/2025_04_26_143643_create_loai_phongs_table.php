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
        Schema::create('loai_phongs', function (Blueprint $table) {
            $table->id();
            $table->string('ten_loai_phong');
            $table->integer('suc_chua');
            $table->integer('so_giuong');
            $table->longText('mo_ta');
            $table->longText('tien_ich');
            $table->integer('tinh_trang')->default(1); // 1: Hoạt động, 0: Ngừng hoạt động
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loai_phongs');
    }
};
