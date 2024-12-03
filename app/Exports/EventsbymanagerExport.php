<?php
namespace App\Exports;

use App\Models\Event;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;

class EventsbymanagerExport implements FromArray{

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

// namespace App\Exports;

// use App\Models\Event;
// use Maatwebsite\Excel\Concerns\FromCollection;

// class EventsbymanagerExport implements FromCollection
// {
//     /**
//     * @return \Illuminate\Support\Collection
//     */
//     public function collection()
//     {
//         return Event::all();
//     }
// }
