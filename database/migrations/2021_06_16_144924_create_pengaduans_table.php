<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengaduansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tanggal_pengaduan');
            $table->text('isi_pengaduan');
            $table->text('file')->nullable();
            $table->text('gambar')->nullable();
            $table->tinyInteger('status_pengaduan')->nullable();
            $table->text('judul_pengaduan');
            $table->date('tanggal_kejadian');
            $table->text('lokasi_pengaduan');
            $table->enum('jenis_pengaduan',['pengaduan','aspirasi']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengaduans');
    }
}
