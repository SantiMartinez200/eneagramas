<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EneagramaPregunta extends Model
{
    protected $fillable = ['eneagramas_base_id', 'pregunta', 'valor'];
    protected $table = 'eneagramas_preguntas';

    public function base()
    {
        return $this->belongsTo(EneagramaBase::class, 'eneagramas_base_id');
    }
}
