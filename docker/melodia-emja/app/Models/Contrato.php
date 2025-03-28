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

    public function musico()
    {
        return $this->belongsTo(Musico::class, 'idMusico', 'idMusico');
    }






























    public function restaurante()
    {
        return $this->belongsTo(Restaurante::class, 'idRestaurante', 'idRestaurante');
    }
}
