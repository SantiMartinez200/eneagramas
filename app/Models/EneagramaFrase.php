<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EneagramaFrase extends Model
{
    protected $fillable = ['eneagramas_base_id','frase'];
    protected $table = 'eneagramas_frases';

    public function eneagrama()
    {
        return $this->belongsTo(EneagramaUsuario::class, 'eneagrama_usuario_id');
    }
}
