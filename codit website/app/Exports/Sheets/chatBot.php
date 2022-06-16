<?php

namespace App\Exports\Sheets;

use App\Models\chat;
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

class chatBot implements FromCollection, WithHeadings, WithTitle, WithStyles, ShouldAutoSize
{
    public $filter;
    public function __construct($filter)
    {
        $this->filter=$filter;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if($this->filter == 1)
        return chat::where('status',1)->get();
        else
        return chat::where('status',0)->get();
    }
    public function title(): string{
        if($this->filter)
        return \App::getLocale()=='ar'?'الردود المفعلة':'Fire Answer';
        else
        return \App::getLocale()=='ar'?'الردود في الانتضار':'ًWhiting Answer';
    }
    public function headings(): array{
        return['#','Q','Q Ar','Answer','Answer Ar','Status','Created_at','Updated_at'];
    }
    public function styles(Worksheet $sheet)
    {
        //defoult style
        $sheet->getParent()->getDefaultStyle()->getFont()->setName('Areal')->setSize(12);

        //
        if(\App::getLocale()=='ar')
        $sheet->setRightToLeft(true);
        //style
        $sheet->getStyle('A1:H1')->getFill()->setFillType(Fill::FILL_SOLID);
        $sheet->getStyle('A1:H1')->getFill()->getStartColor()->setRGB('4b275e');

        $sheet->getStyle('A1:H1')->getFont()->getColor()->setRGB('ffffff');
        $sheet->getStyle('A1:H1')->getAlignment()->setWrapText(true)->setVertical('center')->setHorizontal('center');
        if($sheet->getHighestRow()>1){
            $sheet->getStyle('A2:H'.($sheet->getHighestRow()))->getAlignment()->setWrapText(true)->setVertical('center')->setHorizontal(\App::getLocale()=='ar'?'right':'left');
            $sheet->getStyle('A2:H'.($sheet->getHighestRow()))->getFill()->setFillType(Fill::FILL_SOLID);
            $sheet->getStyle('A2:H'.($sheet->getHighestRow()))->getFill()->getStartColor()->setRGB('f5f5dc');
        }
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true,'size' => 15]],
        ];
    }
}
