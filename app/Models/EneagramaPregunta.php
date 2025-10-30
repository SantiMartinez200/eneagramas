<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EneagramaPregunta extends Model
{
    protected $fillable = ['eneagrama_base_id', 'pregunta', 'tipo'];

    public function base()
    {
        return $this->belongsTo(EneagramaBase::class, 'eneagrama_base_id');
    }
}
