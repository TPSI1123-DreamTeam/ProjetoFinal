<?php

namespace App\Imports;

use App\Models\Participant;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;

class ParticipantsImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //      // Parâmetros a importar têm de corresponder com as colunas do Modelo!!
    //     //'name',
    //     //'phone',
    //     //'email',
    //    // 'confirmation'
    //    return new User([
    //     'name'     => $row[1],
    //     'phone'    => $row[2],
    //     'email' => $row[3],
    //     'confirmation' => $row[4],
    //    ]);
    //    //dd(Participant);
    // }

    public function collection(Collection $rows)
    {
        return new Participant([
                'name'     => $row[1],
                'phone'    => $row[2],
                'email' => $row[3],
                'confirmation' => $row[4],
               ]);
    }
}
