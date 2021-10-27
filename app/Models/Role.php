<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table      = 'roles';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable   = [
        'nama_role'
    ];
    public function dinas()
    {
        return $this->hasOne('App\Models\Dinas');
    }
}
