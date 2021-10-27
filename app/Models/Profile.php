<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'informasi_pu',
        'visi',
        'misi',
        'struktur_organisasi',
        'tugas_pokok',
        'fungsi'
    ];
    public function dinas()
    {
        return $this->belongsTo('App\Models\Dinas');
    }
}
