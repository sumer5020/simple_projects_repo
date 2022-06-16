<?php
use PhpOffice\PhpSpreadsheet\Style\Fill;

        //defoult style
        $sheet->getParent()->getDefaultStyle()->getFont()->setName('Areal')->setSize(12);
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(false)->setWidth(70);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(false)->setWidth(70);
        $sheet->getColumnDimension('L')->setAutoSize(true);
        $sheet->getColumnDimension('M')->setAutoSize(true);
        $sheet->getColumnDimension('N')->setAutoSize(true);
        $sheet->getColumnDimension('O')->setAutoSize(true);
        $sheet->getColumnDimension('P')->setAutoSize(true);
        $sheet->getColumnDimension('Q')->setAutoSize(true);
        //
        if(\App::getLocale()=='ar')
        $sheet->setRightToLeft(true);
        //style
        $sheet->setMergeCells(['A1:K1','L1:M1','N1:Q1']);
        $sheet->getStyle('A1:K1')->getFill()->setFillType(Fill::FILL_SOLID);
        $sheet->getStyle('A1:K1')->getFill()->getStartColor()->setARGB('9acd32');

        $sheet->getStyle('L1:M1')->getFill()->setFillType(Fill::FILL_SOLID);
        $sheet->getStyle('L1:M1')->getFill()->getStartColor()->setRGB('40e0d0');

        $sheet->getStyle('N1:Q1')->getFill()->setFillType(Fill::FILL_SOLID);
        $sheet->getStyle('N1:Q1')->getFill()->getStartColor()->setRGB('ff6347');

        $sheet->getStyle('A2:Q2')->getFill()->setFillType(Fill::FILL_SOLID);
        $sheet->getStyle('A2:Q2')->getFill()->getStartColor()->setRGB('4b275e');
        $sheet->getStyle('A1:Q2')->getFont()->getColor()->setRGB('ffffff');
        $sheet->getStyle('A1:Q2')->getAlignment()->setWrapText(true)->setVertical('center')->setHorizontal('center');
        if($sheet->getHighestRow()>1){
            $sheet->getStyle('A3:Q'.($sheet->getHighestRow()))->getAlignment()->setWrapText(true)->setVertical('center')->setHorizontal(\App::getLocale()=='ar'?'right':'left');
            $sheet->getStyle('A3:Q'.($sheet->getHighestRow()))->getFill()->setFillType(Fill::FILL_SOLID);
            $sheet->getStyle('A3:Q'.($sheet->getHighestRow()))->getFill()->getStartColor()->setRGB('f5f5dc');
        }
        return [
            // Style the first row as bold text.
            2    => ['font' => ['bold' => true,'size' => 13]],
            1    => ['font' => ['bold' => true,'size' => 15]],
        ];
