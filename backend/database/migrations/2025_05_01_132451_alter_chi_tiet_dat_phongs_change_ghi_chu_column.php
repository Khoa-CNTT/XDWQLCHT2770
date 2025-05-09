<?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\Schema;

   class AlterChiTietDatPhongsChangeGhiChuColumn extends Migration
   {
       public function up()
       {
           Schema::table('chi_tiet_dat_phongs', function (Blueprint $table) {
               $table->text('ghi_chu')->nullable()->change();
           });
       }

       public function down()
       {
           Schema::table('chi_tiet_dat_phongs', function (Blueprint $table) {
               // Nếu cần rollback, có thể đổi lại kiểu dữ liệu cũ (ví dụ: integer)
               $table->integer('ghi_chu')->nullable()->change();
           });
       }
   }