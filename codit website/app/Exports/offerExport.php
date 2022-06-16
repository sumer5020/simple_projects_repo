<?php

namespace App\Exports;

//Sheets
use App\Exports\Sheets\completedOffer;
use App\Exports\Sheets\uncompletedOffer;
use App\Exports\Sheets\activeOffer;
use App\Exports\Sheets\unactiveOffer;

//using multiple sheets
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class offerExport implements WithMultipleSheets
{
    public $filter;
    public function __construct($filter)
    {
        $this->filter=$filter;
    }
    //using multiple sheets
    public function sheets(): array
    {
        $sheets=[];
        if($this->filter == 1)
            $sheets=[new completedOffer()];
            else if($this->filter == 2)
            $sheets=[new uncompletedOffer()];
            else if($this->filter == 3)
            $sheets=[new activeOffer(),new unactiveOffer()];
            else if($this->filter == 4)
            $sheets=[new activeOffer()];
            else if($this->filter == 5)
            $sheets=[new unactiveOffer()];
        else
            $sheets=[new completedOffer(),new uncompletedOffer()];
        return $sheets;
    }
}
