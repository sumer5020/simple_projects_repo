<?php

namespace App\Imports;

use App\Models\cati;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Auth;

class catiImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function Collection(Collection $rows)
    {
        //dd($rows);
        $errors=[];
        foreach ($rows as $key => $row) {
            //dd($row);
           if($row[0]!='label'){
            if(!empty($row[0])){
                if(empty(cati::where('label',$row[0])->first())&& str_replace(' ','',$row[0])!='')
                cati::create([
                    'auther_id'=>Auth::user()->id,
                    'label'=>$row[0]
                ]);
                else
                    $errors[$key]='data at row No#($key) is alrady excest';
            }
            else{
                $errors[$key]='cant update empty data at row No#($key)';
            }
           }
        }
        if(empty($errors))
            return redirect()->back()->with('erroes',$errors);
        else
            return back()->with('success','Data updated successfully');
    }
}
