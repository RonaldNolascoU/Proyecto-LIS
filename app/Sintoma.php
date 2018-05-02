<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sintoma extends Model
{
    protected $fillable = ['DescripcionSintoma','consulta_id'];
}
