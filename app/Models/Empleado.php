<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados'; // Asegúrate de que el nombre de la tabla sea correcto
    protected $primaryKey = 'id'; // Define la clave primaria si no es 'id'
    public $timestamps = true; // Si usas created_at y updated_at

    // Define los campos que se pueden asignar masivamente
    protected $fillable = ['nombre', 'email', 'telefono', 'direccion', 'puesto'];
}
