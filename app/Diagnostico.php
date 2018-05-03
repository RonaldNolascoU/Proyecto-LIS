<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    protected $fillable = ['DescripcionDiagnostico','consulta_id'];

    public function medicamentos(){
        return $this->hasMany('App\Medicamento','diagnostico_id');
    }
}
