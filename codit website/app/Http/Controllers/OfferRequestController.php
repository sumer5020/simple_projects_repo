<?php

namespace App\Http\Controllers;

use App\Models\offer_request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\offer;

class OfferRequestController extends Controller
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
            $allCount=offer_request::get()->count();
            $offer_requests=offer_request::paginate(20);
            $count=$offer_requests->count();
            return view("offer_request.index",compact("offer_requests","count","allCount"));
        }
        return back()?back():redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->isAdmin()){
            $users=User::get(['id','name']);
            $offers=offer::get(['id','title','title_ar']);
            $offer_request=new offer_request();
            return view("offer_request.create",compact("users","offers","offer_request"));
        }
        return back()?back():redirect('/');
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
            offer_request::create($this->validateOffer_request());
           return redirect()->action([OfferRequestController::class, 'index']);
        }
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\offer_request  $offer_request
     * @return \Illuminate\Http\Response
     */
    public function show(offer_request $offer_request)
    {
        return back()?back():redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\offer_request  $offer_request
     * @return \Illuminate\Http\Response
     */
    public function edit(offer_request $offer_request)
    {
        if(Auth::user()->isAdmin()){
            $users=User::get(['id','name']);
            $offers=offer::get(['id','title','title_ar']);
            return view("offer_request.edit",compact("offers","users","offer_request"));
        }
        return back()?back():redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\offer_request  $offer_request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, offer_request $offer_request)
    {
        if(Auth::user()->isAdmin()){
            $offer_request->update($this->validateOffer_request());
           return redirect()->action([OfferRequestController::class, 'index']);
        }
        return back()?back():redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\offer_request  $offer_request
     * @return \Illuminate\Http\Response
     */
    public function destroy(offer_request $offer_request)
    {
        if(Auth::user()->isAdmin()){
            $offer_request->delete();
           return redirect()->action([OfferRequestController::class, 'index']);
        }
        return back()?back():redirect('/');
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\offer_request  $offer_request
     * @return \Illuminate\Http\Response
     */
    public function destroySome(Request $request, offer_request $offer_request){

        if(Auth::user()->isAdmin()){
            offer_request::destroy($request->idList);
            return response()->json(['success'=>'200']);
        }
        return back()?back():redirect('/');
    }

    //Validate offer Data
    public function validateOffer_request(){
        return request()->validate([
            'user_id'=>'required|integer|min:1',
            'offer_id'=>'required|integer|min:1',
            'details'=>'required|string|min:20|max:700',
            'status'=>'sometimes|integer|min:0|max:1',
            'created_at'=>'sometimes|date',
        ]);
    }
}
