<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kelurahans');
            $table->foreign('id_kelurahans')
                  ->references('id')
                  ->on('kelurahans')
                  ->onDelete('cascade');
            $table->Integer('tahun');
            $table->Integer('semester');
            $table->unsignedBigInteger('id_jenis_datas');
            $table->foreign('id_jenis_datas')
                  ->references('id')
                  ->on('jenis_datas')
                  ->onDelete('cascade');
            $table->String('keterangan');
            $table->String('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporans');
    }
}
