<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;
    protected $table      = 'pengaduans';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'tanggal_pengaduan', 'isi_pengaduan', 'file', 'gambar', 'status_pengaduan', 'judul_pengaduan', 'tanggal_kejadian', 'lokasi_pengaduan', 'jenis_pengaduan', 'pegawai_dinas_id', 'rakyat_id', 'kategori_pengaduan_id'];

    public function dinas()
    {
        return $this->belongsTo('App\Models\Dinas');
    }
    public function rakyat()
    {
        return $this->belongsTo('App\Models\Rakyat');
    }
    public function kategori_pengaduan()
    {
        return $this->belongsTo('App\Models\KategoriPengaduan');
    }
}
