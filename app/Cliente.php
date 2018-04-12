<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['PrimerNombre','SegundoNombre','PrimerApellido','SegundoApellido','DUI','Correo','Telefono','Imagen','clave'];
}
