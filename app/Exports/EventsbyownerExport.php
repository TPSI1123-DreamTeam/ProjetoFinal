<?php

namespace App\Exports;

use App\Models\Event;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;

class EventsbyownerExport implements FromArray{

    protected $newExcelArray;

    public function __construct($newExcelArray)
    {
        $this->newExcelArray = $newExcelArray;
    }

    public function array(): array
    {
        return $this->newExcelArray;
    }
}

// class EventsbyownerExport implements FromQuery
// {
//     use Exportable;

//     public function __construct(int $userId)
//     {
//         $this->userId = $userId;
//     }

//     public function query()
//     {
//         return Event::query()->where('owner_id', $this->userId);
//     }
// }