<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Models\Country;
use App\Models\Gov;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('['auth','verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authUser=Auth::user();
        if($authUser->isAdmin()){
            $allCount=User::where('rule','customer')->count();
            $users=User::where('rule','customer')->paginate(20);
            $count=count($users);
            return view('users.customer.index',compact('users','count','allCount'));
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
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if(Auth::user()->isAdmin()){
            $countrys=Country::get();
            $ccountry=Country::UserCountry()->get()->first();
            $cgov=Gov::UserGov()->get()->first();
            return view('users.show',compact('user','cgov','ccountry'));
        }
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $authUser=Auth::user();
        if($authUser->isAdmin()){
            if(($user->rule == 'sprov' && $authUser->rule == 'sprov') || ($user->rule != 'sprov')){
                $countrys=Country::get();
                $govs=Gov::where('country_id',$user->profile->country)->get();
                return view('users.edit',compact('user','countrys','govs'));
            }
        }
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $authUser=Auth::user();
        $targetRule=$user->rule;
        if($authUser->isAdmin()){
            $data=$request->validate([
                'name' => 'required|string|max:60|min:2',
                'phone1' => 'sometimes|integer|min:700000000|max:779999999|nullable',
                'phone2' => 'sometimes|integer|min:700000000|max:779999999|nullable',
                'username'=>'required|string|max:30|min:2|unique:users,username,'.$user->id.'id,',
                'email'=>'required|email|max:30|min:7|unique:users,email,'.$user->id.'id,',
            ]);

            $profileData=$request->validate([
                'about'=>'sometimes|string|min:1|max:500|nullable',
                'nick_name'=>'sometimes|string|min:2|max:50|nullable',
                'gender'=>'sometimes|integer|min:1|max:2|nullable',
                'browser'=>'sometimes|string|min:2|max:20|nullable',
                'platform'=>'sometimes|string|min:2|max:20|nullable',
                'country'=>'sometimes|integer|min:1|max:999|nullable',
                'gov'=>'sometimes|integer|min:1|max:9999|nullable',
                'district'=>'sometimes|string|min:2|max:30|nullable',
            ]);
            $conEmail=$request->validate([
                'conEmail'=>'sometimes|email|max:30|min:7',
            ]);

            $profileData['email']=$conEmail['conEmail'];

            if($authUser->isSouperAdmin()){
                $data+=$request->validate([
                    'email_verified_at' => 'sometimes|date|nullable',
                    'rule' => 'sometimes|string|in:customer,sprov,prov',
                    'status' => 'sometimes|integer|max:1|min:0',
                ]);
                if((User::where('rule','sprov')->get()->count()<2 || $user->id==$authUser->id) && $user->rule=='sprov'){
                    if(!$data['rule']=='sprov' || $data['status']==0)
                    return redirect("supperAdmin")->with('msg','400');
                }
            }

            $user->update($data);
            $user->profile->update($profileData);
            $this->storeFile($user);
            if($targetRule == 'customer')
            return redirect()->action([UserController::class, 'index']);
            else
            return redirect("supperAdmin");

        }
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $authUser=Auth::user();
        if($authUser->isAdmin()){
            if($user->rule == 'customer'){
                $user->profile->delete();
                $user->delete();
            }
            else if($authUser->isSouperAdmin()){
                if($user->id ==$authUser->id)
                    return back()->with('msg','400');
                else
                    User::where('id',$user->id)->update(['status'=>0]);
            }
        }

        return back() ? back() : redirect('/');
    }

    //get admin to list
    public function admin(){
        $authUser=Auth::user();
        if($authUser->isAdmin()){
            $allCount=User::where('rule','prov')->count();
            $users=User::where('rule','prov')->paginate(20);
            $count=count($users);
            return view('users.admin.index',compact('users','count','allCount'));
        }
    }

    //get supper admin to manage
    public function supperAdmin(){
        $authUser=Auth::user();
        if($authUser->isAdmin()){

            $aallCount=User::where('rule','prov')->count();
            $ausers=User::where('rule','prov')->paginate(20);
            $acount=count($ausers);

            $users=User::where('rule','sprov')->get();
            $allCount=User::where('rule','sprov')->count();
            return view('users.s_admin.index',compact('users','allCount','ausers','acount','aallCount'));
        }
        return redirect('/');
    }

    /**
     * Remove the specified admin.
     */
    public function aDestroySome(Request $request){
        $authUser=Auth::user();
        if($authUser->isSouperAdmin()){
            User::whereIn('id',$this->checkSupperAdmin($request->idList,1))->update(['status'=>0]);
            return response()->json(['success'=>'200']);
        }
        return response()->json(['success'=>'400']);
    }

    /**
     * Remove the specified customer.
     */
    public function cDestroySome(Request $request){
        $authUser=Auth::user();
        if($authUser->isAdmin()){
            $list=$this->checkSupperAdmin($request->idList,0);
            Profile::destroy($list);
            User::destroy($list);
            return response()->json(['success'=>'200']);
        }
        return redirect('/');
    }

    /**
     * chick is deleted admin or customer and filter supper admin from delete.
     */
    public function checkSupperAdmin($idList,$prov){
        $authUser=Auth::user();
        if($authUser->isAdmin()){
            $newList=array();
            //the deleted is admin
            if($prov){
                if(!$authUser->rule=='sprov')
                return [];
                for($i=0;$i<count($idList);$i++){
                    if(count(User::where('id',$idList[$i])->get())>0 && $authUser->id !=$idList[$i]){
                        $newList[]=$idList[$i];
                    }
                }
            }
            //the deleted is customer
            else{
                for($i=0;$i<count($idList);$i++){
                    if(count(User::where('id',$idList[$i])->where('rule','customer')->get())>0){
                        $newList[]=$idList[$i];
                    }
                }
            }
            return $newList;
        }
        return redirect('/');
    }

        //Store profile Files
        public function storeFile($user){
            if(request()->has('img')){
                request()->validate([
                    'img'=>'sometimes|image|mimes:jpeg,png,jpg|max:5000|nullable',
                ]);
                if($user->profile->img){
                    unlink(public_path().'/storage/'.$user->profile->img);
                }
                $user->profile->update([
                    'img'=>request()->img->store('profile/img','public'),
                ]);

                //====================== Resize without strtch ==============================
                $bg=Image::canvas(500,500);
                $img=Image::make(public_path('storage/'.$user->profile->img))->resize(500,500,function($c){
                    $c->aspectRatio();
                    $c->upsize();
                });
                $bg->insert($img,'center');
                $img->save();
            }
        }
}
