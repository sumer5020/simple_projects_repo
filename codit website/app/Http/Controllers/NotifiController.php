<?php

namespace App\Http\Controllers;

use App\Models\notifi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\newApplyToOfferEvent;
use App\Models\offer;
use App\Models\offer_request;

class NotifiController extends Controller
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
        //
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\notifi  $notifi
     * @return \Illuminate\Http\Response
     */
    public function show(notifi $notifi)
    {
        //
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\notifi  $notifi
     * @return \Illuminate\Http\Response
     */
    public function edit(notifi $notifi)
    {
        //
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\notifi  $notifi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, notifi $notifi)
    {
        //
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\notifi  $notifi
     * @return \Illuminate\Http\Response
     */
    public function destroy(notifi $notifi)
    {
        //
        return redirect('/');
    }

    /**
     * manage Offers Mailable.
     * @return \Illuminate\Http\Response
     */
    public function offerNotify(Request $request,offer_request $offer_request){

        $mailData;
        //save offer in db and send it to the emails
        if(Auth::check()){
            $user=Auth::user();
            $super=\App\User::where('rule','sprov')->get()->first();
            $data=$request->validate([
                'details'=>'required|string|max:700|min:20',
                'offer_id'=>'required|integer|min:1'
            ]);
            $data['user_id']=$user->id;
            $offer=offer::where('id',$request->offer_id)->first();
            if(count($offer)>0){
                $offer_request=$offer_request->create($data);
                $offer->update([
                    'pay_count'=>offer_request::where('offer_id',$offer->id)->get()->count()
                ]);

                $applyData=[
                    'admin_email'=>$super?$super->email:'sumer5020@outlook.com',
                    'admin_name'=>$super?$super->name:'sumer5020',
                    'customer_name'=>$user->name,
                    'customer_email'=>$user->email,
                    'customer_phone1'=>$user->phone1,
                    'customer_phone2'=>$user->phone2,
                    'order_id'=>$offer_request->id,
                    'offer_cost'=>$offer->cost,
                    'offer_title'=>(App()->getLocale()=='ar'?$offer->title_ar:$offer->title),
                    'offer_desc'=>(App()->getLocale()=='ar'?$offer->desc_ar:$offer->desc),
                    'order_details'=>$offer_request->details,
                    'created_at'=>$offer_request->created_at
                ];

                //mailable event
                event(new newApplyToOfferEvent($applyData));

                return response()->json(['success'=>'200']);
            }
            return response()->json(['success'=>'401']);
        }
        return response()->json(['success'=>'401']);
    }
}
