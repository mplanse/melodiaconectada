<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;
    protected $table = 'mensajes';
    protected $primaryKey = 'idMensaje';
    public $timestamps = false;
    protected $fillable = ['timestamp', 'origen_usuarios_idUsuario', 'destino_usuarios_idUsuario'];
    
    public function origen()
    {
        return $this->belongsTo(Origen::class, 'origen_usuarios_idUsuario', 'usuarios_idUsuario');
    }
    
    public function destino()
    {
        return $this->belongsTo(Destino::class, 'destino_usuarios_idUsuario', 'usuarios_idUsuario');
    }
}
