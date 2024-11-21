<?php

namespace App\Exports;

use App\Models\Participant;
use App\Models\User;
use App\Models\Event;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Concerns\WithProperties;

class ParticipantsExport implements FromArray
{

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        $newExcelArray = [];
        $tempExcelArray[0] = 'N';
        $tempExcelArray[1] = 'Name';
        $tempExcelArray[2] = 'Phone';
        $tempExcelArray[3] = 'Email';
        $tempExcelArray[4] = 'Confirmation';


        $newExcelArray[] = $tempExcelArray;

        foreach ($this->data as $key => $value) {
            $tempExcelArray[0] = $key+1;
            $tempExcelArray[1] = $value->name;
            $tempExcelArray[2] = $value->phone;
            $tempExcelArray[3] = $value->email;
            $tempExcelArray[4] = $value->pivot->confirmation == true ? 'Sim' : 'Não';
            $newExcelArray[] = $tempExcelArray;
        }


        return $newExcelArray;

    }


    // public function properties(): array
    // {
    //     return [
    //         'creator'        => $participants->name,
    //         'lastModifiedBy' => 'Patrick Brouwers',
    //         'title'          => 'Invoices Export',
    //         'description'    => 'Latest Invoices',
    //         'subject'        => 'Invoices',
    //         'keywords'       => 'invoices,export,spreadsheet',
    //         'category'       => 'Invoices',
    //         'manager'        => 'Patrick Brouwers',
    //         'company'        => 'Maatwebsite',
    //     ];
    // }
}
