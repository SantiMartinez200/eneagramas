<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EneagramaFrase extends Model
{
    protected $table = 'eneagramas_frases';
    protected $fillable = ['eneagramas_base_id','frase'];

    public function base()
    {
        return $this->belongsTo(EneagramaBase::class, 'eneagramas_base_id');
    }
}
