<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    
    protected $table = 'notas';

    public $timestamps = false; 

    // Propiedad fillable
    protected $fillable = [
        'titulo',      // Asegúrate de agregar todos los campos que desees permitir
        'descripcion',
        'fecha',
        'etiquetas',
        'idUsu',
    ];
}
