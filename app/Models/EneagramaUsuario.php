<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EneagramaUsuario extends Model
{
    protected $fillable = ['user_id', 'base_id', 'nombre'];
    protected $table = 'eneagramas_usuario';

    public function preguntas()
    {
        return $this->hasMany(EneagramaUsuarioPregunta::class, 'eneagrama_usuario_id');
    }

    public function base()
    {
        return $this->belongsTo(EneagramaBase::class, 'base_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}