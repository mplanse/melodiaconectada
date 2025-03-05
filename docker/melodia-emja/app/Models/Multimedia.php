<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Multimedia extends Model
{
    use HasFactory;
    protected $table = 'multimedia';
    protected $primaryKey = 'idmultimedia';
    public $timestamps = false;
    protected $fillable = ['url', 'idPropietario'];
    
    public function propietario()
    {
        return $this->belongsTo(Usuario::class, 'idPropietario', 'idUsuario');
    }
}