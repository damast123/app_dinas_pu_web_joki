<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetaWilayahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peta_wilayahs', function (Blueprint $table) {
            $table->id();
            $table->text('judul');
            $table->date('tanggal_dibuat');
            $table->text('deskripsi');
            $table->text('file')->nullable();
            $table->text('gambar')->nullable();
            $table->text('link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peta_wilayahs');
    }
}
