<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPerintahs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('perintahs', function (Blueprint $table) {
            $table->bigInteger('pegawai_dinas_pembuat')->unsigned();
            $table->bigInteger('pegawai_dinas_tujuan')->unsigned();
            $table->foreign('pegawai_dinas_pembuat')->references('id')->on('pegawai_dinas');
            $table->foreign('pegawai_dinas_tujuan')->references('id')->on('pegawai_dinas');
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
