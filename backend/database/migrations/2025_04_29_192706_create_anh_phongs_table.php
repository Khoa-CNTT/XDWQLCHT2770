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
        Schema::create('anh_phongs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('phong_id')->constrained('phongs')->onDelete('cascade');
            $table->string('url'); // URL của hình ảnh
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anh_phongs');
    }
};
