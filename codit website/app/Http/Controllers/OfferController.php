<?php

namespace App\Http\Controllers;

use App\Models\offer;
use App\Models\cati;
use App\Models\follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\newOfferCreatedEvent;

class OfferController extends Controller
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
            $allCount=offer::get()->count();
            $offers=offer::paginate(20);
            $count=$offers->count();
            return view("offer.index",compact("offers","count","allCount"));
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
            $offer=new offer();
            $catis=cati::get();

            return view("offer.create",compact("catis","offer"));
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
            $offerData=$this->validateOffer();
            $followers=array();
            offer::create($offerData);
            //mailable event
            $all=follow::get('email');
            foreach($all as $folower){
                $followers[]=$folower->email;
            }
            if(count($followers) > 0){
                event(new newOfferCreatedEvent($followers,$offerData));
            }
            return redirect()->action([OfferController::class, 'index']);
        }
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(offer $offer)
    {
        if(Auth::user()->isAdmin()){
            return view("offer.show",compact("offer"));
        }
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(offer $offer)
    {
        if(Auth::user()->isAdmin()){
            $catis=cati::get();
            return view("offer.edit",compact("catis","offer"));
        }
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, offer $offer)
    {
        if(Auth::user()->isAdmin()){
            $offer->update($this->validateOffer());
            return redirect()->action([OfferController::class, 'index']);
        }
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(offer $offer){

        if(Auth::user()->isAdmin()){
            $offer->delete();
            return redirect()->action([OfferController::class, 'index']);
        }
        return redirect('/');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\offer  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroySome(Request $request, offer $offer){

        if(Auth::user()->isAdmin()){
            offer::destroy($request->idList);
            return response()->json(['success'=>'200']);
        }
        return redirect('/');
    }

    //Validate offer Data
    public function validateOffer(){
        $data= request()->validate([
            'cost'=>'required|numeric|min:0|max:99999.99',
            'title'=>'required|string|min:2|max:50',
            'desc'=>'required|string|min:2|max:300',
            'title_ar'=>'required|string|min:2|max:50',
            'desc_ar'=>'required|string|min:2|max:300',
            'pay_count'=>'sometimes|integer|min:0|max:999999',
            'start_at'=>'required|date',
            'end_at'=>'required|date|after:'.request()->start_at,
            'status'=>'sometimes|integer|min:0|max:1',
            'cati_id'=>'sometimes|integer|min:1',
        ]);
        $data['auther_id']=Auth::user()->id;
        return $data;
    }
}
