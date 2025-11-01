<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EneagramaVerbo extends Model
{
   protected $table = 'eneagramas_verbos';
   protected $fillable = ['eneagramas_base_id','verbo'];


}
