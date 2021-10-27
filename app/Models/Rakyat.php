<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rakyat extends Authenticable
{
    use Notifiable,HasFactory;

    protected $table      = 'rakyats';
    protected $primaryKey = 'id';

    protected $guard = 'masyarakat';

    protected $fillable = [
        'name', 'alamat', 'jenis_kelamin', 'no_telp', 'email', 'username', 'password','email_verfied_at'
    ];

    protected $hidden = ['password'];

    public function pengaduan()
    {
        return $this->hasMany('App\Models\Pengaduan');
    }
}
