<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EneagramaUsuarioPregunta extends Model
{
    protected $table = 'eneagramas_preguntas_usuario';
    protected $fillable = ['eneagrama_usuario_id', 'pregunta', 'valor'];

    public function cuestionario()
    {
        return $this->belongsTo(EneagramaUsuario::class, 'eneagrama_usuario_id');
    }
}
