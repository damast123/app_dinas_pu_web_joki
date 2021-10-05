<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perintah extends Model
{
    use HasFactory;
    protected $table      = 'perintahs';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'no_surat_perintah', 'tanggal', 'pesan', 'lokasi', 'laporan', 'file', 'gambar', 'status', 'dinas_pembuat', 'dinas_tujuan'];

    public function dinas_pembuat()
    {
        return $this->belongsTo('App\Models\Dinas');
    }
    public function dinas_tujuan()
    {
        return $this->belongsTo('App\Models\Dinas');
    }
}
