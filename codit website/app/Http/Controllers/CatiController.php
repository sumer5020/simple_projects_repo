<?php

namespace App\Http\Controllers;

use App\Models\cati;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->isAdmin()){
            $catis=cati::paginate(20);
            $count=$catis->count();
            $allCount=cati::get()->count();
            return view("components.cati.index",compact("catis","count","allCount"));
        }
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->isAdmin()){
            $cati=new cati();
            return view("components.cati.create",compact("cati"));
        }
        return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->isAdmin()){
        //str_replace('/', '-', app()->getLocale())
        cati::create($this->validateCati());
        return redirect()->action([CatiController::class, 'index']);
        }
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cati  $cati
     * @return \Illuminate\Http\Response
     */
    public function show(cati $cati)
    {
        return redirect()->action([CatiController::class, 'index']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cati  $cati
     * @return \Illuminate\Http\Response
     */
    public function edit(cati $cati)
    {
        if(Auth::user()->isAdmin()){
            return view("components.cati.edit",compact("cati"));
        }
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cati  $cati
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cati $cati)
    {
        if(Auth::user()->isAdmin()){
            $cati->update($this->validateCati());
            return redirect()->action([CatiController::class, 'index']);
        }
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cati  $cati
     * @return \Illuminate\Http\Response
     */
    public function destroy(cati $cati)
    {
        if(Auth::user()->isAdmin()){
            $cati->delete();
            return redirect()->action([CatiController::class, 'index']);
        }
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cati  $cati
     * @return \Illuminate\Http\Response
     */
    public function destroySome(Request $request, cati $cati)
    {
        if(Auth::user()->isAdmin()){
            cati::destroy($request->idList);
            return response()->json(['success'=>'200']);
        }
        return redirect('/');
    }

    //Validate cati Data
    public function validateCati(){
        $data = request()->validate([
            'label'=>'required|string|min:2|max:20',
        ]);
        $data['auther_id']=Auth::user()->id;
        return $data;
    }
}
