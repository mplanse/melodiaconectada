<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Origen extends Model
{
    use HasFactory;
    protected $table = 'origen';
    protected $primaryKey = 'usuarios_idUsuario';
    public $timestamps = false;
    
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuarios_idUsuario', 'idUsuario');
    }
}