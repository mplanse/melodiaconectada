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
    protected $fillable = [
        'origen_usuarios_idUsuario',
        'destino_usuarios_idUsuario',
        'texto_mensaje',
        'timestamp'
    ];

    // Relationship to sender user
    public function remitente()
    {
        return $this->belongsTo(Usuario::class, 'origen_usuarios_idUsuario', 'idUsuario');
    }

    // Relationship to recipient user
    public function destinatario()
    {
        return $this->belongsTo(Usuario::class, 'destino_usuarios_idUsuario', 'idUsuario');
    }

    // Add a timestamp setter for easier message creation
    public function setTimeStampAttributes()
    {
        $this->timestamp = now();
    }
}
