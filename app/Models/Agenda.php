<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;
    protected $table      = 'agendas';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nama_event', 'tanggal_mulai', 'tanggal_akhir', 'jam', 'isi_event', 'tempat_event', 'pegawai_dinas_id'];


    public function dinas()
    {
        return $this->belongsTo('App\Models\Dinas');
    }
}
