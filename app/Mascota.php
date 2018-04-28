<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    protected $fillable = ['NombreMascota','FechaNacimiento','Imagen','tipo_id','cliente_id'];

    public function tipo(){
        return $this->belongsTo('App\TipoMascota','tipo_id');
    }

    public function cliente(){
        return $this->belongsTo('App\Cliente','cliente_id');
    }

    public function caracteristicas(){
        return $this->hasMany('App\Caracteristica','mascota_id');
    }

    public function consultas(){
        return $this->hasMany('App\Consulta','mascota_id');
    }
}
