<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CountryController extends Controller
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
            $countrys=country::paginate(20);
            $count=$countrys->count();
            $allCount=country::get()->count();
            return view("addriss.country.index",compact("countrys","count","allCount"));
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
            $country=new country();
            return view("addriss.country.create",compact("country"));
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
            country::create($this->validateCountry());
            return redirect()->action([CountryController::class, 'index']);
        }
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(country $country)
    {
        if(Auth::user()->isAdmin()){
            return view("addriss.country.show",compact("country"));
        }
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(country $country)
    {
        if(Auth::user()->isAdmin()){
            return view("addriss.country.edit",compact("country"));
        }
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, country $country)
    {
        if(Auth::user()->isAdmin()){
            $country->update($this->validateCountry());
            return redirect()->action([CountryController::class, 'index']);
        }
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(country $country)
    {
        if(Auth::user()->isAdmin()){
            $country->delete();
            return redirect()->action([CountryController::class, 'index']);
        }
        return redirect('/');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroySome(Request $request, country $country)
    {
        if(Auth::user()->isAdmin()){
            country::destroy($request->idList);
            return response()->json(['success'=>'200']);
        }
        return redirect('/');
    }

    //Validate country Data
    public function validateCountry(){
        return request()->validate([
            'short'=>'required|string|min:2|max:2',
            'label'=>'required|string|min:2|max:20',
            'label_ar'=>'required|string|min:2|max:20',
        ]);
    }
}
