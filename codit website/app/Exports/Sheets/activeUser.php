<?php

namespace App\Exports\Sheets;

use App\Models\User;
use App\Models\Country;
use App\Models\Gov;

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

class activeUser implements FromGenerator, ShouldAutoSize, WithTitle, WithStyles
{
    use Exportable;

    public function generator(): Generator
    {
        //user info title
        yield [\App::getLocale()=='en'?'Account Basic Info':'معلومات الحساب الاساسية','','','','','','','',\App::getLocale()=='en'?'user Profile Info':'معلومات الصفحة الشخصية','','','','',''];
        yield \App::getLocale()=='en'?['#','Name','Username','Phone1','Phone2','Email','Created At','Updated At','Contact Email','Nick Name','Gender','About','Address','User Locale Inv']:
        ['#','الاسم','اسم المسخدم','رقم الهاتف 1','رقم الهاتف 2','البريد الالكتروني','تاريخ الانشاء','تاريح التحديث','البريد التواصل','الاسم الوضيفي','الجنس','حول المسخحدم','العنوان','معلومات البنية التحتية'];
        //user info
        $users= User::where('status',1)->get(['id','name','username','phone1','phone2','email','created_at','updated_at']);
        foreach($users as $user){
            $user['contactEmail']=$user->profile['email'];
            $user['nick_name']=$user->profile['nick_name'];
            $user['gender']=($user->profile['gender']==1?'Male':$user->profile['gender']==2?'Female':'_');
            $user['about']=$user->profile['about'];
            $country=country::where('id',$user->profile['country'])->get()->first();
            $gov=gov::where('id',$user->profile['gov'])->get()->first();
            if(\App::getLocale()=='ar')
            $user['addriss']=$country['label'].'_'.$gov['label'].'_'.$user->profile['district'];
            else
            $user['addriss']=$country['label_ar'].'_'.$gov['label_ar'].'_'.$user->profile['district'];
            $user['userLocalInv']='[ '.$user->profile['platform'].' | '.$user->profile['browser'].' ]';
            yield $user;
        }
    }

    public function title(): string{
        return \App::getLocale()=='ar'?'المستخدمين الفعليين':'Active Users';
    }

    //working styling
    public function styles(Worksheet $sheet)
    {
        include(__DIR__.'/../Styles/userStyle.php');
    }
}
