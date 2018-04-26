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
}
