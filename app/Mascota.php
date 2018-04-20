<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    protected $fillable = ['NombreMascota','FechaNacimiento','Imagen','tipo_id','cliente_id'];

    public function tipo(){
        return $this->belongsTo('App\TipoMascota','tipo_id');
    }
}
