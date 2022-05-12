<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daerah extends Model
{
    use HasFactory;
    protected $table      = 'daerahs';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['nama_daerah'];
    public function peta_wilayah()
    {
        return $this->hasOne('App\Models\PetaWilayah');
    }
}
