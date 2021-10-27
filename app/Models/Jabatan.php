<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $table      = 'jabatans';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable   = [
        'nama_jabatan'
    ];
    public function dinas()
    {
        return $this->hasOne('App\Models\Dinas');
    }
}
