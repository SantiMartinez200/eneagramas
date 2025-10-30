<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EneagramaBase extends Model
{
    protected $fillable = ['nombre', 'descripcion'];

    public function preguntas()
    {
        return $this->hasMany(EneagramaPregunta::class);
    }
}
