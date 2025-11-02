<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EneagramaUsuarioVerbo extends Model
{
    protected $table = 'eneagramas_usuario_verbos';
    protected $fillable = ['eneagrama_usuario_id','verbo'];

    public function cuestionario()
    {
        return $this->belongsTo(EneagramaUsuario::class, 'eneagrama_usuario_id');
    }
}
