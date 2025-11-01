<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EneagramaBase extends Model
{
    protected $fillable = ['id','base','nombre', 'descripcion'];
    protected $table = 'eneagramas_base';

    public function preguntas()
    {
        return $this->hasMany(EneagramaPregunta::class, 'eneagramas_base_id');
    }
}
