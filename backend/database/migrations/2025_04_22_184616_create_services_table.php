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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('ten_dich_vu');
            $table->string('icon');
            $table->string('mo_ta');
            $table->integer('gia');
            $table->string('don_vi');
            $table->integer('tinh_trang')->default(1); // 1: Hoạt động, 0: Ngừng hoạt động
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
