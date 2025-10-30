<?php

namespace App\Imports;

use App\Models\EneagramaPregunta;
use Maatwebsite\Excel\Concerns\ToModel;

class EneagramaPreguntasImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new EneagramaPregunta([
            'pregunta' => $row['pregunta'],
            'tipo' => $row['tipo'],
        ]);
    }
}
