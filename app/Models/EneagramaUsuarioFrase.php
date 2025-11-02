<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EneagramaUsuarioFrase extends Model
{
    protected $table = 'eneagramas_usuario_frases';
    protected $fillable = ['eneagrama_usuario_id','frase'];

    public function cuestionario()
    {
        return $this->belongsTo(EneagramaUsuario::class, 'eneagrama_usuario_id');
    }
}
