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
            $table->bigInteger('dinas_pembuat')->unsigned();
            $table->bigInteger('dinas_tujuan')->unsigned();
            $table->foreign('dinas_pembuat')->references('id')->on('dinas');
            $table->foreign('dinas_tujuan')->references('id')->on('dinas');
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
