<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerintahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perintahs', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat_perintah')->unique();
            $table->date('tanggal');
            $table->text('pesan');
            $table->text('lokasi');
            $table->text('laporan');
            $table->text('file')->nullable();
            $table->text('gambar')->nullable();
            $table->tinyInteger('status');
            $table->softDeletes();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perintahs');
    }
}
