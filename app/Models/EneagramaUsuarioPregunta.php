<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EneagramaUsuarioPregunta extends Model
{
    protected $fillable = ['eneagrama_usuario_id', 'pregunta', 'tipo'];

    public function cuestionario()
    {
        return $this->belongsTo(EneagramaUsuario::class, 'eneagrama_usuario_id');
    }
}
