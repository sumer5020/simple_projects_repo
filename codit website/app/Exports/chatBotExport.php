<?php

namespace App\Exports;

//Sheets
use App\Exports\Sheets\chatBot;

//using multiple sheets
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class chatBotExport implements WithMultipleSheets
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
            $sheets=[new chatBot(0)];
        else if($this->filter == 2)
            $sheets=[new chatBot(1)];
        else
            $sheets=[new chatBot(0),new chatBot(1)];
        return $sheets;
    }
}
