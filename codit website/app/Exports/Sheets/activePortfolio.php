<?php

namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\FromCollection;

class activePortfolio implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
    }
}
