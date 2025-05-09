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
        Schema::create('phongs', function (Blueprint $table) {
            $table->id();
            $table->string('ten_phong');
            $table->string('id_homestay');
            $table->string('mo_ta');
            $table->integer('dien_tich');
            $table->integer('gia');
            $table->string('tien_ich');
            $table->integer('suc_chua');
            $table->integer('so_giuong');
            $table->integer('trang_thai')->default(1); // 0: Bảo trì, 1: hoạt động
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phongs');
    }
};
