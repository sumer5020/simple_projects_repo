<?php

namespace App\Exports\Sheets;

use App\Models\offer;

//collect data with generator
use Generator;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromGenerator;
//sheet title
use Maatwebsite\Excel\Concerns\WithTitle;
//auto sizing colomn in sheet
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
//working with style
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class activeOffer implements FromGenerator, ShouldAutoSize, WithTitle, WithStyles
{
    use Exportable;

    public function generator(): Generator
    {
        //Offer titles
        yield ['#','Catigury','title Ar','title En','Description En','Description Ar','Cost','Pay Count','Start At','End At','Created At','Updated At'];

        $offers=offer::where('status',1)->get();
        foreach($offers as $offer){
            yield [$offer['id'],$offer->cati['label'],$offer['title'],$offer['title_ar'],$offer['desc'],
            $offer['desc_ar'],$offer['cost'].'$',$offer['pay_count'],$offer['start_at'],$offer->offer['end_at']
            ,$offer->offer['created_at'],$offer->offer['updated_at']];
        }
    }

    public function title(): string{
        return \App::getLocale()=='ar'?'العروض الحالية':'ِActive offer';
    }

    //working styling
    public function styles(Worksheet $sheet)
    {include(__DIR__.'/../Styles/offerStyle.php');}
}
