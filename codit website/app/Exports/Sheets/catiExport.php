<?php

namespace App\Exports\Sheets;

use App\Models\cati;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

//sheet title
use Maatwebsite\Excel\Concerns\WithTitle;
//auto sizing colomn in sheet
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
//working with style
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;


class catiExport implements FromCollection, WithHeadings, WithTitle, WithStyles, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $catis=cati::all();
        $collect=[];
        foreach($catis as $key=>$cati){
            $collect[$key]=$cati;
            $author=User::where('id',$cati->auther_id)->get('name')->first();
            $collect[$key]['auther_name']=$author['name'];
        }
        return $collect;
    }
    public function title(): string{
        return \App::getLocale()=='ar'?'التصنيفات':'ًCatiguries';
    }
    public function headings(): array{
        return['#','Author Id','Author Name','Label','Created_at','Updated_at'];
    }
    public function styles(Worksheet $sheet)
    {
        //defoult style
        $sheet->getParent()->getDefaultStyle()->getFont()->setName('Areal')->setSize(12);

        //
        if(\App::getLocale()=='ar')
        $sheet->setRightToLeft(true);
        //style
        $sheet->getStyle('A1:F1')->getFill()->setFillType(Fill::FILL_SOLID);
        $sheet->getStyle('A1:F1')->getFill()->getStartColor()->setRGB('4b275e');

        $sheet->getStyle('A1:F1')->getFont()->getColor()->setRGB('ffffff');
        $sheet->getStyle('A1:F1')->getAlignment()->setWrapText(true)->setVertical('center')->setHorizontal('center');
        if($sheet->getHighestRow()>1){
            $sheet->getStyle('A2:F'.($sheet->getHighestRow()))->getAlignment()->setWrapText(true)->setVertical('center')->setHorizontal(\App::getLocale()=='ar'?'right':'left');
            $sheet->getStyle('A2:F'.($sheet->getHighestRow()))->getFill()->setFillType(Fill::FILL_SOLID);
            $sheet->getStyle('A2:F'.($sheet->getHighestRow()))->getFill()->getStartColor()->setRGB('f5f5dc');
        }
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true,'size' => 15]],
        ];
    }
}
