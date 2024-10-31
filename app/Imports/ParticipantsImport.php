<?php

namespace App\Imports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\ToModel;

class ParticipantsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
         // Parâmetros a importar têm de corresponder com as colunas do Modelo!!
        //'name',
        //'phone',
        //'email',
       // 'confirmation'
       return new Participant([
        'name'     => $row[1],
       'phone'    => $row[2],
       'email' => $row[3],
       'confirmation' => $row[4],
       ]);
    }
}
