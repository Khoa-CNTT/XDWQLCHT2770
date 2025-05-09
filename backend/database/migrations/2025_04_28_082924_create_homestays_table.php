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
        Schema::create('homestays', function (Blueprint $table) {
            $table->id();
            $table->string('ten_homestay');
            $table->string('dia_chi');
            $table->string('mo_ta');
            $table->string('tien_ich');
            $table->integer('tinh_trang')->default(1); //1:hoạt động  0:ngung hoạt động
            $table->string('anh_chinh');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homestays');
    }
};
