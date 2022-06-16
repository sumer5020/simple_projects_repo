<?php

namespace App\Exports;

//Sheets
use App\Exports\Sheets\userChat;

//using multiple sheets
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class userMessageExport implements WithMultipleSheets
{
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
