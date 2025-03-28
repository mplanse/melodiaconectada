<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Musico extends Model
{
    use HasFactory;
    protected $table = 'musicos';
    protected $primaryKey = 'idMusico';
    public $timestamps = false;
    protected $fillable = ['descripcion', 'precio', 'generosMusicales_idGenero', 'lat', 'long'];

    public function genero()
    {
        return $this->belongsTo(GeneroMusical::class, 'generosMusicales_idGenero', 'idGenero');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idMusico', 'idUsuario');
    }

    public function contrato()
    {
        return $this->hasOne(Contrato::class, 'idMusico', 'idMusico');
    }

}
