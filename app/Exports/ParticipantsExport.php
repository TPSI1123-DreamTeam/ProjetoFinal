<?php

namespace App\Exports;

use App\Models\Participant;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class ParticipantsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }
}
