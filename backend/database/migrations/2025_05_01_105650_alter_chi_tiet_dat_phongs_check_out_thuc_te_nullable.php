<?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\Schema;

   class AlterChiTietDatPhongsCheckOutThucTeNullable extends Migration
   {
       public function up()
       {
           Schema::table('chi_tiet_dat_phongs', function (Blueprint $table) {
               $table->date('check_out_thuc_te')->nullable()->change();
           });
       }

       public function down()
       {
           Schema::table('chi_tiet_dat_phongs', function (Blueprint $table) {
               $table->date('check_out_thuc_te')->nullable(false)->change();
           });
       }
   }