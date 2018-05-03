<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    protected $fillable = ['NombreMedicamento', 'Medida','diagnostico_id','tipo_medicamento_id'];
}
