<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sintoma extends Model
{
    protected $fillable = ['DecripcionSintoma','consulta_id'];
}
