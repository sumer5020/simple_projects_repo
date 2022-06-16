<?php

namespace App\Exports\Sheets;

use App\Models\offer_request;
use App\Models\User;

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

class completedOffer implements FromGenerator, ShouldAutoSize, WithTitle, WithStyles
{
    use Exportable;

    public function generator(): Generator
    {
        //Offer request titles
        yield [(\App::getLocale()=='en'?'Offer Info':'معلومات العرض'),'','','','','','','','','','',(\App::getLocale()=='en'?'Request details':'تفاصيل الطلب'),'',(\App::getLocale()=='en'?'Consumer Info':'معلومات الزبون')];
        yield \App::getLocale()=='en'?['#','Catigury','Offer title','Description','Cost','Start At','End At','Author name','Author email','offer Status','Consumer Request details','Request date','Consumer name','Consumer email','contact email','Consumer phone1','Consumer phone2']:
        ['#','التصنيف','عنوان العرض','وصف العرض','كلفة العرض','تاريخ البدء','تاريخ الانهاء','اسم مزود العرض','ايميل مزود العرض','حالة العرض','تفاصيل طلب العميل','تاريخ الطلب','اسم العميل','ايميل العميل','ايميل التواصل','رقم العميل 1','رقم العميل 2'];
        $Offer_requests=offer_request::where('status',0)->get();
        foreach($Offer_requests as $Offer_request){
            //Author info
            $Author=User::where('id',($Offer_request->offer['auther_id']))->get(['name','email'])->first();
            //Collecting info
            if(\App::getLocale()=='en')
            $offerRequest=[$Offer_request['id'],$Offer_request->offer->cati['label'],$Offer_request->offer['title'],$Offer_request->offer['desc'],$Offer_request->offer['cost'].'$'
            ,$Offer_request->offer['start_at'],$Offer_request->offer['end_at'],$Author['name'],$Author['email'],$Offer_request->offer['status']?'available':'_'
            ,$Offer_request['details'],$Offer_request['created_at'],$Offer_request->user['name'],$Offer_request->user['email'],$Offer_request->user->profile['email']
            ,$Offer_request->user['phone1'],$Offer_request->user['phone2']];
            else
            $offerRequest=[$Offer_request['id'],$Offer_request->offer->cati['label'],$Offer_request->offer['title_ar'],$Offer_request->offer['desc_ar'],$Offer_request->offer['cost'].'$'
            ,$Offer_request->offer['start_at'],$Offer_request->offer['end_at'],$Author['name'],$Author['email'],$Offer_request->offer['status']?'متاح':'_'
            ,$Offer_request['details'],$Offer_request['created_at'],$Offer_request->user['name'],$Offer_request->user['email'],$Offer_request->user->profile['email']
            ,$Offer_request->user['phone1'],$Offer_request->user['phone2']];
            yield $offerRequest;
        }
    }

    public function title(): string{
        return \App::getLocale()=='ar'?'طلبات العروض المكتملة':'Completed offer request';
    }

    //working styling
    public function styles(Worksheet $sheet)
    {include(__DIR__.'/../Styles/offerRequestStyle.php');}
}
