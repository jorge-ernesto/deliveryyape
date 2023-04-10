<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //use HasFactory;

    protected $table      = "cliente"; //Nombre de la Base de Datos
    protected $primaryKey = "id";      //Primary Key de la Base de Datos
    public $timestamps    = false;     //Guardar o no los campos timestamps: created_at y updated_at, como referencia podemos ver dichos campos en la tabla users

    //Estos son los campos que van a ser rellenables de la base de datos, que vamos asignar al modelo
    protected $fillable = [
        "apellidos",
        "nombre",
        "documento",
        "direccion",
        "telefono",
        "email"
    ];
}
