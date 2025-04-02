<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;
    protected $table = 'usuarios';
    protected $primaryKey = 'idUsuario';
    public $timestamps = false;
    protected $fillable = ['username', 'password', 'mail', 'roles_idRol', 'nombre', 'descripcion'];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'roles_idRol', 'idRol');
    }

    public function restaurante()
    {
        return $this->hasOne(Restaurante::class, 'idRestaurante', 'idUsuario');
    }
}
