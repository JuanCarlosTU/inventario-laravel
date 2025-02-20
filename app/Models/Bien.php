<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    use HasFactory;

    // Permite la asignación en masa de estos campos
    protected $table = 'bienes';
    protected $fillable = [
        'nombre', 
        'descripcion', 
        'cantidad',
        'prestados',
        'imagen',
        'ubicacion' 
        // Agrega aquí los campos que quieres permitir
    ];
    protected $primaryKey = 'id'; // Especificar la clave primaria
    public $incrementing = true; // Asegurar que es autoincremental
    protected $keyType = 'int'; // Definir que la clave es de tipo entero
}

