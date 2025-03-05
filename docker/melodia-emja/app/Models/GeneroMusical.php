<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class GeneroMusical extends Model
{
    use HasFactory;
    protected $table = 'generosmusicales';
    protected $primaryKey = 'idGenero';
    public $timestamps = false;
    protected $fillable = ['nombreGenero'];
}
