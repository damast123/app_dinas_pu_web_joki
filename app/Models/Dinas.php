<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Dinas extends Authenticable
{
    use Notifiable,HasFactory;

    protected $table      = 'dinas';
    protected $primaryKey = 'id';
    protected $guard = 'admin';

    protected $fillable = [
        'name', 'alamat', 'tanggal_lahir', 'tempat_lahir', 'no_telp','email', 'username', 'password', 'email_verfied_at', 'jabatan_id', 'role_id'
    ];

    protected $hidden = ['password'];

    public function jabatan()
    {
        return $this->belongsTo('App\Models\Jabatan');
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }
}
