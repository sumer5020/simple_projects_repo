<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Excel;

use \App\Exports\userExport;
use \App\Exports\offerExport;
use \App\Exports\chatBotExport;

class importExportController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    /*
    ***************************************
    * Reports Views
    ***************************************
    */
    public function usersReport(){
        return view('reports.users');
    }

    /*
    ***************************************
    * Import Functions
    ***************************************
    */

    //Import cati
    /*public function catiImport(Request $request){
        $data=$request->validate([
            'cati_file'=>'required|file|mimes:xls,xlsx,csv',
        ]);
        $file=$request->file('cati_file');
        Excel::import(new catiImport,$file);
        return redirect()->back()->with('success','All data successfully imported!');
    }*/

    /*
    ***************************************
    * Export Functions
    ***************************************
    */
    //Export users
    public function userExport($id){
        if(Auth::user()->isSouperAdmin()){
            $fileName='allUsers';
            if($id==1)$fileName='activeUsers';else if($id==2)$fileName='unactiveUsers';else if($id==3)$fileName='adminUsers';
            return Excel::download(new userExport($id),$fileName.now()->format('(Y-m-s h.i.s)').'codit.xlsx');
        }
        return back()?back():redirect('/');
    }

    //Export offer
    public function offerExport($id){
        if(Auth::user()->isSouperAdmin()){
            $fileName='allOfferRequest';
            if($id==1)$fileName='completedRequest';else if($id==2)$fileName='unCompletedRequest';
            else if($id==3)$fileName='AllOffers';else if($id==4)$fileName='ActiveOffers';else if($id==5)$fileName='AnactiveOffers';
            return Excel::download(new offerExport($id),$fileName.now()->format('(Y-m-s h.i.s)').'codit.xlsx');
        }
        return back()?back():redirect('/');
    }

    //Export chat bot
    public function chatBotExport($id){
        if(Auth::user()->isSouperAdmin()){
            $fileName='allChatBotAnswer';
            if($id==1)$fileName='fireChatBotAnswer';else if($id==2)$fileName='whitingChatBotAnswer';
            return Excel::download(new chatBotExport($id),$fileName.now()->format('(Y-m-s h.i.s)').'codit.xlsx');
        }
        return back()?back():redirect('/');
    }

    //Export chat bot
    public function contentExport(){
        if(Auth::user()->isSouperAdmin()){
            $fileName='DB_Content';
            return Excel::download(new contentExport(),$fileName.now()->format('(Y-m-s h.i.s)').'codit.xlsx');
        }
        return back()?back():redirect('/');
    }
}
