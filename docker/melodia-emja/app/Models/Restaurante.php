<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurante extends Model
{
    use HasFactory;
    protected $table = 'restaurantes';
    protected $primaryKey = 'idRestaurante';
    public $timestamps = false;
    protected $fillable = ['direccion'];

    public function eventos()
    {
        return $this->hasMany(Evento::class, 'restaurantes_idRestaurante', 'idRestaurante');
    }

    public function contrato()
    {
        return $this->hasOne(Contrato::class, 'idRestaurante', 'idRestaurante');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idRestaurante', 'idUsuario');
    }

}
