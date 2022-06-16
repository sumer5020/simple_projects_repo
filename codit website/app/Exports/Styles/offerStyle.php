<?php
use PhpOffice\PhpSpreadsheet\Style\Fill;

        //defoult style
        $sheet->getParent()->getDefaultStyle()->getFont()->setName('Areal')->setSize(12);
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(false)->setWidth(70);
        $sheet->getColumnDimension('F')->setAutoSize(false)->setWidth(70);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);
        $sheet->getColumnDimension('L')->setAutoSize(true);

        //
        if(\App::getLocale()=='ar')
        $sheet->setRightToLeft(true);
        //style
        $sheet->getStyle('A1:L1')->getFill()->setFillType(Fill::FILL_SOLID);
        $sheet->getStyle('A1:L1')->getFill()->getStartColor()->setRGB('4b275e');

        $sheet->getStyle('A1:L1')->getFont()->getColor()->setRGB('ffffff');
        $sheet->getStyle('A1:L1')->getAlignment()->setWrapText(true)->setVertical('center')->setHorizontal('center');
        if($sheet->getHighestRow()>1){
            $sheet->getStyle('A2:L'.($sheet->getHighestRow()))->getAlignment()->setWrapText(true)->setVertical('center')->setHorizontal(\App::getLocale()=='ar'?'right':'left');
            $sheet->getStyle('A2:L'.($sheet->getHighestRow()))->getFill()->setFillType(Fill::FILL_SOLID);
            $sheet->getStyle('A2:L'.($sheet->getHighestRow()))->getFill()->getStartColor()->setRGB('f5f5dc');
        }
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true,'size' => 15]],
        ];
