<?php

namespace App\Http\Controllers;

use App\Models\portfolio;
use App\Models\cati;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PortfolioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except("rate","more");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if(Auth::user()->isAdmin()){
            $portfolios=portfolio::paginate(20);
            //splet 160 charecter for post
            $count=0;
            foreach($portfolios as $portfolio){
                $portfolios[$count]->post=substr($portfolio->post,0,160);
                $portfolios[$count]->post_ar=substr($portfolio->post_ar,0,160);
                $count++;
            }
            $count=$portfolios->count();
            $allCount=portfolio::get()->count();
            return view("portfolio.index",compact("portfolios","count","allCount"));
        }
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        if(Auth::user()->isAdmin()){
            $catis=cati::get();
        $portfolio=new portfolio();
        return view("portfolio.create",compact("portfolio","catis"));
        }
        return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        if(Auth::user()->isAdmin()){
            $portfolio=portfolio::create($this->validateportfolio());
            $this->storeFile($portfolio);
            return redirect()->action([PortfolioController::class, 'index']);
        }
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(portfolio $portfolio){

        if(Auth::user()->isAdmin()){
            return view("portfolio.show",compact("portfolio"));
        }
        return redirect('/');
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function more(portfolio $portfolio){
        $author=\App\Models\User::where('id',$portfolio->auther_id)->first();
        $portfolio->post=Explode('.',$portfolio->post );
        $portfolio->post_ar=Explode('.',$portfolio->post_ar );
        $trinds=portfolio::where('id','!=',$portfolio->id)->where('cati_id',$portfolio->cati_id)->orderBy('created_at','DESC')->orderBy('rate_up','DESC')->take(10)->get();
        $authorLasts=portfolio::where('id','!=',$portfolio->id)->where('auther_id',$portfolio->auther_id)->orderBy('created_at','DESC')->take(10)->get();
        return view("portfolio.more",compact("portfolio","trinds","authorLasts","author"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(portfolio $portfolio){

        if(Auth::user()->isAdmin()){
            $catis=cati::get();
            return view("portfolio.edit",compact("portfolio","catis"));
        }
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, portfolio $portfolio){

        if(Auth::user()->isAdmin()){
            $portfolio->update($this->validateportfolio());
            $this->storeFile($portfolio);
            return redirect()->action([PortfolioController::class, 'index']);
        }
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(portfolio $portfolio){

        if(Auth::user()->isAdmin()){
            $portfolio->delete();
            return redirect()->action([PortfolioController::class, 'index']);
        }
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroySome(Request $request, portfolio $portfolio){
        if(Auth::user()->isAdmin()){
            portfolio::destroy($request->idList);
            return response()->json(['success'=>'200']);
        }
        return redirect('/');
    }

    /**
     * rate single portfolio.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function rate(Request $request, portfolio $portfolio){
        if(Auth::check()){
            $user=Auth::user();
            $portfolio=(portfolio::where('id',$request->postId)->get())->first();
            switch($request->rateType){
                case 'up':{$user->portfolios()->syncWithoutDetaching([$request->postId=>['rate'=>1]]);break;}
                case 'down':{$user->portfolios()->syncWithoutDetaching([$request->postId=>['rate'=>-1]]);break;}
                case '_down':{}
                case '_up':{$user->portfolios()->detach([$request->postId]);break;}
                default:{return response()->json(['success'=>'404']);}
            }
                $portfolio->rate_up=count(DB::table('portfolio_user')->where('portfolio_id',$request->postId)->where('rate',1)->get());
                $portfolio->rate_down=count(DB::table('portfolio_user')->where('portfolio_id',$request->postId)->where('rate',-1)->get());
                $portfolio->update();

            return response()->json([
                'success'=>'200',
                'up'=>$portfolio->rate_up,
                'down'=>$portfolio->rate_down
                ]);
        }
        return response()->json(['success'=>'401']);
    }

    //Validate portfolio Data
    public function validateportfolio(){
        $data= request()->validate([
            'cati_id'=>'required|integer|min:1',
            'title'=>'required|string|min:2|max:50',
            'post'=>'required|string|min:2|max:3000',
            'title_ar'=>'required|string|min:2|max:50',
            'post_ar'=>'required|string|min:2|max:3000',
            'media_vid'=>'sometimes|url|max:250|nullable',
            //'media_vid'=>'sometimes|file|max:80000|mimes:mp4,avi',
            'color'=>'sometimes|string|min:7|max:7',
            'rate_up'=>'sometimes|integer|min:0',
            'rate_down'=>'sometimes|integer|min:0',
            'status'=>'sometimes|integer|min:0|max:1',
        ]);
        $data['auther_id']=Auth::user()->id;
        return $data;
    }

    //Store portfolio Files
    public function storeFile($portfolio){

        if(Auth::user()->isAdmin()){
            if(request()->has('media_pic')){
                request()->validate([
                    'media_pic'=>'sometimes|image|mimes:jpeg,png,jpg|max:5000',
                ]);

                if($portfolio->media_pic){
                    unlink(public_path().'/storage/'.$portfolio->media_pic);
                }
                $portfolio->update([
                    'media_pic'=>request()->media_pic->store('portfolio/img','public'),
                ]);

                //====================== Resize without strtch ==============================
                $bg= Image::canvas(600,600);
                $img=Image::make(public_path('storage/'.$portfolio->media_pic))->resize(600,600,function($c){
                    $c->aspectRatio();
                    $c->upsize();
                });
                $bg->insert($img,'center');
                $img->save();
            }
        }
        return redirect('/');
    }

}
