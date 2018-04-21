<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
    protected $fillable = ['DescripcionCaracteristica','mascota_id'];

    public function mascota(){
        return $this->belongsTo('App\Mascota','mascota_id');
    }
}
