<?php

namespace App\Imports;

use App\Models\Participant;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ParticipantsImport implements ToModel, WithHeadingRow, WithStartRow
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

    public function model(array $row)
    {
       // return $rows;
        return new Participant([
                'name'     => $row[1],
                'phone'    => $row[2],
                'email' => $row[3],
                'confirmation' => $row[4],
               ]);
    }

    public function startRow(): int
    {
        return 0;
    }
}
