<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Gov;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GovController extends Controller
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
            $govs=gov::paginate(20);
            $count=$govs->count();
            $allCount=gov::get()->count();
            return view("addriss.gov.index",compact("govs","count","allCount"));
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
            $countrys=country::get();
            $gov=new gov();
            return view("addriss.gov.create",compact("gov","countrys"));
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
            gov::create($this->validateGov());
            return redirect()->action([GovController::class, 'index']);
        }
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\gov  $gov
     * @return \Illuminate\Http\Response
     */
    public function show(gov $gov)
    {
        if(Auth::user()->isAdmin()){
            $country=country::get('id',$gov->id);
            return view("addriss.gov.show",compact("gov","country"));
        }
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\gov  $gov
     * @return \Illuminate\Http\Response
     */
    public function edit(gov $gov)
    {
        if(Auth::user()->isAdmin()){
            $countrys=country::get();
            return view("addriss.gov.edit",compact("countrys","gov"));
        }
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\gov  $gov
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, gov $gov)
    {
        if(Auth::user()->isAdmin()){
            $gov->update($this->validateGov());
            return redirect()->action([GovController::class, 'index']);
        }
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\gov  $gov
     * @return \Illuminate\Http\Response
     */
    public function destroy(gov $gov)
    {
        if(Auth::user()->isAdmin()){
            $gov->delete();
            return redirect()->action([GovController::class, 'index']);
        }
        return redirect('/');
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\gov  $gov
     * @return \Illuminate\Http\Response
     */
    public function destroySome(Request $request, gov $gov)
    {
        if(Auth::user()->isAdmin()){
            gov::destroy($request->idList);
            return response()->json(['success'=>'200']);
        }
        return redirect('/');
    }

    //Validate gov Data
    public function validateGov(){
        return request()->validate([
            'country_id'=>'required|integer|min:1',
            'label'=>'required|string|min:2|max:20',
            'label_ar'=>'required|string|min:2|max:20',
        ]);
    }
}
