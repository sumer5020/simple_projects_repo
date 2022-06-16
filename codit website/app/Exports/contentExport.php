<?php

namespace App\Exports;

//Sheets
use App\Exports\Sheets\catiExport;
use App\Exports\Sheets\iconExport;
use App\Exports\Sheets\followExport;
use App\Exports\Sheets\addriss;

//using multiple sheets
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class contentExport implements WithMultipleSheets
{
    //using multiple sheets
    public function sheets(): array
    {
        return [new catiExport(),new iconExport(),new followExport(),new addriss()];
    }
}
