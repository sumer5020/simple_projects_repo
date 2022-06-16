<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardsController extends Controller
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
            $cards=Card::paginate(20);
            $count=$cards->count();
            $allCount=Card::get()->count();
            return view("Cards.index",compact("cards","count","allCount"));
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
            $Card=new Card();
            $icons=icon::get();
            return view("Cards.create",compact("icons","Card"));
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
            Card::create($this->validateCard());
            return redirect()->action([CardsController::class, 'index']);
        }
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Card  $Card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $Card)
    {
        if(Auth::user()->isAdmin()){
            return view("cards.show",compact("Card"));
        }
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Card  $Card
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $Card)
    {
        if(Auth::user()->isAdmin()){
            $icons=icon::get();
            return view("cards.edit",compact("Card","icons"));
        }
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Card  $Card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $Card)
    {
        if(Auth::user()->isAdmin()){
            $Card->update($this->validateCard());
            return redirect()->action([CardsController::class, 'index']);
        }
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Card  $Card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $Card)
    {
        if(Auth::user()->isAdmin()){
            $Card->delete();
            return redirect()->action([CardsController::class, 'index']);
        }
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Card  $Card
     * @return \Illuminate\Http\Response
     */
    public function destroySome(Request $request, Card $Card)
    {
        if(Auth::user()->isAdmin()){
            Card::destroy($request->idList);
            return response()->json(['success'=>'200']);
        }
        return redirect('/');
    }

    //Validate Card Data
    public function validateCard(){
        $data= request()->validate([
            'title'=>'required|string|min:2|max:20',
            'title_ar'=>'required|string|min:2|max:20',
            'desc'=>'required|string|min:2|max:250',
            'desc_ar'=>'required|string|min:2|max:250',
            'icon'=>'required|string|min:8|max:20',
        ]);
        $data['auther_id']=Auth::user()->id;
        return $data;
    }
}
