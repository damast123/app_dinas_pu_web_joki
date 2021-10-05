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
        'file', 'gambar', 'dinas_id'];

    public function dinas()
    {
        return $this->belongsTo('App\Models\Dinas');
    }

}
