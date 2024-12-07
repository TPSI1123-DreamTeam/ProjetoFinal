<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class SuppliersExport implements FromArray
{
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