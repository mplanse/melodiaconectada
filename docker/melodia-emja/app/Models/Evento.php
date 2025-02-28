<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;
    protected $table = 'eventos';
    protected $primaryKey = 'idEventos';
    public $timestamps = false;
    protected $fillable = ['nombreEvento', 'descripcion', 'urlMultimedia', 'fecha', 'precio', 'restaurantes_idRestaurante'];
    
    public function restaurante()
    {
        return $this->belongsTo(Restaurante::class, 'restaurantes_idRestaurante', 'idRestaurante');
    }
}
