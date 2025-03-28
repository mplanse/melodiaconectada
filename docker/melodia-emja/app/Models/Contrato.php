<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    protected $table = 'contratos';
    protected $primaryKey = 'idContrato';
    public $timestamps = false;
    protected $fillable = ['idMusico', 'idRestaurante', 'fechaContrato', 'activo', 'precioContrato'];

    // Relación con Musico (Uno a uno)
    public function musico()
    {
        return $this->belongsTo(Musico::class, 'idMusico', 'idMusico');
    }

    // Relación con Restaurante (Uno a uno)
    public function restaurante()
    {
        return $this->belongsTo(Restaurante::class, 'idRestaurante', 'idRestaurante');
    }
}




























    public function restaurante()
    {
        return $this->belongsTo(Restaurante::class, 'idRestaurante', 'idRestaurante');
    }
}
