<?php

namespace App\Exports;

use App\Models\Participant;
use App\Models\User;
use App\Models\Event;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Concerns\WithProperties;

class ParticipantsExport implements WithProperties
{
    public function properties(): array
    {
        return [
            'creator'        => $participants->name,
            'lastModifiedBy' => 'Patrick Brouwers',
            'title'          => 'Invoices Export',
            'description'    => 'Latest Invoices',
            'subject'        => 'Invoices',
            'keywords'       => 'invoices,export,spreadsheet',
            'category'       => 'Invoices',
            'manager'        => 'Patrick Brouwers',
            'company'        => 'Maatwebsite',
        ];
    }
}
