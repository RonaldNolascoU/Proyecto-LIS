<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoMascota extends Model
{
    protected $fillable = ['NombreTipo'];

    public function mascotas(){
        return $this->hasMany('Mascota');
    }
}
