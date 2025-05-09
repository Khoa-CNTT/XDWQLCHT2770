<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTienIchColumnInPhongsTable extends Migration
{
    public function up()
    {
        Schema::table('phongs', function (Blueprint $table) {
            $table->text('tien_ich')->change();
        });
    }

    public function down()
    {
        Schema::table('phongs', function (Blueprint $table) {
            $table->string('tien_ich', 255)->change(); // hoặc số ký tự cũ
        });
    }
}
