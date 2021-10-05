<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPengaduan extends Model
{
    use HasFactory;
    protected $table      = 'kategori_pengaduans';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nama'];
}
