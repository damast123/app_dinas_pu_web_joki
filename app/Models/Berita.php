<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    protected $table      = 'beritas';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'tanggal_berita', 'tanggal_muat', 'judul_berita', 'isi_berita', 'gambar_berita', 'dinas_id'];


    public function dinas()
    {
        return $this->belongsTo('App\Models\Dinas');
    }
}
