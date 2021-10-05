<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPengaduans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->bigInteger('dinas_id')->nullable()->unsigned();
            $table->bigInteger('rakyat_id')->unsigned();
            $table->bigInteger('kategori_pengaduan_id')->unsigned();
            $table->foreign('dinas_id')->references('id')->on('dinas');
            $table->foreign('rakyat_id')->references('id')->on('rakyats');
            $table->foreign('kategori_pengaduan_id')->references('id')->on('kategori_pengaduans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
