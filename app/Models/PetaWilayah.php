<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetaWilayah extends Model
{
    use HasFactory;
    protected $table      = 'peta_wilayahs';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'judul', 'deskripsi', 'tanggal_dibuat', 'file', 'gambar', 'link','pegawai_dinas_id','daerah_id'];

    public function dinas()
    {
        return $this->belongsTo('App\Models\Dinas');
    }

    public function daerah()
    {
        return $this->belongsTo('App\Models\Daerah');
    }

}
