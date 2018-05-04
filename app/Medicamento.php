<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    protected $fillable = ['NombreMedicamento', 'Medida','diagnostico_id','tipo_medicamento_id'];

    public function tipo(){
        return $this->belongsTo('App\TipoMedicamento','tipo_medicamento_id');
    }
}
