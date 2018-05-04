<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $fillable = ['FechaConsulta','HoraLlegada','Peso','Altura','mascota_id','user_id','Estado'];

    public function mascota(){
        return $this->belongsTo('App\Mascota','mascota_id');
    }

    public function veterinario(){
        return $this->belongsTo('App\User','user_id');
    }

    public function diagnosticos(){
        return $this->hasMany('App\Diagnostico','consulta_id');
    }

    public function servicios(){
        return $this->hasMany('App\Servicio','consulta_id');
    }
}
