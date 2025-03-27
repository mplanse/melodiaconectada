<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destino extends Model
{
    use HasFactory;
    protected $table = 'destino';
    protected $primaryKey = 'usuarios_idUsuario';
    public $timestamps = false;
    protected $fillable = ['usuarios_idUsuario'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuarios_idUsuario', 'idUsuario');
    }
}
