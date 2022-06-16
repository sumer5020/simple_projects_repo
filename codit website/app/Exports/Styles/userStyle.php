<?php
use PhpOffice\PhpSpreadsheet\Style\Fill;
 //defoult style
 $sheet->getParent()->getDefaultStyle()->getFont()->setName('Areal')->setSize(12);
 $sheet->getColumnDimension('L')->setAutoSize(false)->setWidth(70);
 $sheet->getColumnDimension('A')->setAutoSize(true);
 $sheet->getColumnDimension('B')->setAutoSize(true);
 $sheet->getColumnDimension('C')->setAutoSize(true);
 $sheet->getColumnDimension('D')->setAutoSize(true);
 $sheet->getColumnDimension('E')->setAutoSize(true);
 $sheet->getColumnDimension('F')->setAutoSize(true);
 $sheet->getColumnDimension('G')->setAutoSize(true);
 $sheet->getColumnDimension('H')->setAutoSize(true);
 $sheet->getColumnDimension('I')->setAutoSize(true);
 $sheet->getColumnDimension('J')->setAutoSize(true);
 $sheet->getColumnDimension('K')->setAutoSize(true);
 $sheet->getColumnDimension('M')->setAutoSize(true);
 $sheet->getColumnDimension('N')->setAutoSize(true);
 //
 if(\App::getLocale()=='ar')
 $sheet->setRightToLeft(true);
 //style
 $sheet->setMergeCells(['A1:H1','I1:N1']);
 $sheet->getStyle('A1:H1')->getFill()->setFillType(Fill::FILL_SOLID);
 $sheet->getStyle('A1:H1')->getFill()->getStartColor()->setARGB('ffaca376');

 $sheet->getStyle('I1:N1')->getFill()->setFillType(Fill::FILL_SOLID);
 $sheet->getStyle('I1:N1')->getFill()->getStartColor()->setRGB('baaac4');

 $sheet->getStyle('A2:N2')->getFill()->setFillType(Fill::FILL_SOLID);
 $sheet->getStyle('A2:N2')->getFill()->getStartColor()->setRGB('4b275e');

 $sheet->getStyle('A1:N2')->getFont()->getColor()->setRGB('ffffff');
 $sheet->getStyle('A1:N2')->getAlignment()->setWrapText(true)->setVertical('center')->setHorizontal('center');
 $sheet->getStyle('A3:N'.($sheet->getHighestRow()))->getAlignment()->setWrapText(true)->setVertical('center')->setHorizontal(\App::getLocale()=='ar'?'right':'left');
 $sheet->getStyle('A3:N'.($sheet->getHighestRow()))->getFill()->setFillType(Fill::FILL_SOLID);
 $sheet->getStyle('A3:N'.($sheet->getHighestRow()))->getFill()->getStartColor()->setRGB('fff2e6');
 return [
     // Style the first row as bold text.
     2    => ['font' => ['bold' => true,'size' => 13]],
     1    => ['font' => ['bold' => true,'size' => 15]],
 ];
