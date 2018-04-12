<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['PrimerNombre','SegundoNombre','PrimerApellido','SegundoApellido','DUI','NIT','Correo','Telefono','Imagen','clave'];
}
