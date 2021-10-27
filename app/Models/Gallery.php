<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $table      = 'galleries';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'file', 'title', 'keterangan'];
    public function dinas()
    {
        return $this->belongsTo('App\Models\Dinas');
    }
}
