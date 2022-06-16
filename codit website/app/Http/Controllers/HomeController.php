<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Models\User; use App\Models\Card; use App\Models\offer; use App\Models\cati;
use App\Models\portfolio;
use App\Models\chat_message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('welcome','language','rates');
        //$this->middleware('['auth','verified'])->except('welcome','language');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users=User::get();
        $messages=[];
        if(Auth::user()->rule=='sprov'){
            return view('home.sa_home',compact('users'));
        }
        elseif(Auth::user()->rule=='prov'){
            return view('home.a_home',compact('users'));
        }else{
            return redirect('/');
        }
    }

    public function welcome()
    {
        //Get User MSGs
        $messages=[];
        if(Auth::check()){
            $allCount=chat_message::MessageOfID(Auth::user()->id)->get()->count();
            if($allCount>20)
            $messages=chat_message::MessageOfID(Auth::user()->id)->skip($allCount-20)->take(20)->get();
            else
            $messages=chat_message::MessageOfID(Auth::user()->id)->get();
        }

        //Cards Of Values
        $cards=Card::get();

        //Catiguris Of Values
        $catis=cati::get();

        //Cards of Portfolios
        $portfolios=portfolio::IsOn()->get();
        //splet 160 charecter for post
        $count=0;
        foreach($portfolios as $portfolio){
            $portfolios[$count]->post=substr($portfolio->post,0,160);
            $portfolios[$count]->post_ar=substr($portfolio->post_ar,0,160);
            $count++;
        }

        //Cards of Offers
        $offers=offer::IsOn()->IsStart()->get();

        return view('index',compact("cards","portfolios","offers","catis","messages"));
    }

    public function rates(){
        //Get rated Portfolio
        if(Auth::check()){
            if(request()->has('postId')){
                $rate=DB::table('portfolio_user')->where('user_id',Auth::user()->id)->where('portfolio_id',request()->postId)->get('rate')->first();
                return response()->json(['success'=>'200','rate'=>$rate]);
            }
            $ratedPortfolios=DB::table('portfolio_user')->select('portfolio_id','rate')->where('user_id',Auth::user()->id)->get();
            return response()->json(['success'=>'200','rates'=>$ratedPortfolios]);
        }
        return response()->json(['success'=>'404']);
    }

    public function language($language){
        if($language=='ar' || $language=='en'){
            session()->put('language',$language);
            App::setLocale($language);
        }
        return back()?back():redirect('/');
    }
}
