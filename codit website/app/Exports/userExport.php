<?php

namespace App\Exports;

//Sheets
use App\Exports\Sheets\activeUser;
use App\Exports\Sheets\unactiveUser;
use App\Exports\Sheets\adminUsers;

//using multiple sheets
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class userExport implements WithMultipleSheets
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
            $sheets=[new activeUser()];
        else if($this->filter == 2)
            $sheets=[new unactiveUser()];
        else if($this->filter == 3)
            $sheets=[new adminUsers()];
        else
            $sheets=[new activeUser(),new unactiveUser(),new adminUsers()];
        return $sheets;
    }
}
