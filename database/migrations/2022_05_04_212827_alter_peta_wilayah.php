<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPetaWilayah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('peta_wilayahs', function (Blueprint $table) {
            $table->bigInteger('pegawai_dinas_id')->unsigned();
            $table->bigInteger('daerah_id')->unsigned();
            $table->foreign('pegawai_dinas_id')->references('id')->on('pegawai_dinas');
            $table->foreign('daerah_id')->references('id')->on('daerahs');
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
