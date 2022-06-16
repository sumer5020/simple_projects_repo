<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Country;
use App\Models\Gov;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $countrys=Country::get();
        $ccountry=Country::UserCountry()->get()->first();
        $cgov=Gov::UserGov()->get()->first();
        $govs=Gov::get();
        return view('profile.index',compact('countrys','govs','cgov','ccountry'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(profile $profile){
        //
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(profile $profile){
        //
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\profile  $profile
     * * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, profile $profile){
        if(request()->has('name')){
            $user=Auth::user();
            $data=request()->validate([
                'name'=>'required|string|min:2|max:60',
                'phone1'=>'sometimes|integer|min:700000000|max:999779999999|nullable',
                'phone2'=>'sometimes|integer|min:700000000|max:999779999999|nullable',
            ]);
            $user->update($data);
            $profile->update($this->validateprofile());
            return response()->json(['success'=>'200']);
        }
        else if(request()->has('password')){
            $user=Auth::user();
            $data=request()->validate([
                'password' => 'required|string|min:8|max:255|confirmed',
            ]);
            if(Hash::check($data['password'], $user->password)){
                return response()->json(['success'=>'201']);
            }
            $data['password']=Hash::make($data['password']);
            $user->update($data);
            return response()->json(['success'=>'200']);
        }
        else if(request()->has('advanced')){
            $profile->update($this->validateprofile());
            return response()->json(['success'=>'200']);
        }else{
            $profile->update($this->validateprofile());
            $this->storeFile($profile);
        }

        return redirect()->action([ProfileController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(profile $profile){
        //
        return redirect('/');
    }

    //Validate profile Data
    public function validateprofile(){
        return request()->validate([
            'q1'=>'sometimes|string|min:2|max:20|nullable',
            'a1'=>'sometimes|string|min:2|max:20|nullable',
            'q2'=>'sometimes|string|min:2|max:20|nullable',
            'a2'=>'sometimes|string|min:2|max:20|nullable',
            'about'=>'sometimes|string|min:1|max:500|nullable',
            'nick_name'=>'sometimes|string|min:2|max:50|nullable',
            'gender'=>'sometimes|integer|min:1|max:2|nullable',
            'email'=>'sometimes|email|min:8|max:30',
            'browser'=>'sometimes|string|min:2|max:20|nullable',
            'platform'=>'sometimes|string|min:2|max:20|nullable',
            'country'=>'sometimes|integer|min:1|max:999|nullable',
            'gov'=>'sometimes|integer|min:1|max:9999|nullable',
            'district'=>'sometimes|string|min:2|max:30|nullable',
            'img'=>'sometimes|image|mimes:jpeg,png,jpg|max:5000|nullable',
        ]);
    }

    //Store profile Files
    public function storeFile($profile){
        if(request()->has('personalPic')){
            request()->validate([
                'personalPic'=>'sometimes|image|mimes:jpeg,png,jpg|max:5000|nullable'
            ]);
            if($profile->img){
                unlink(public_path().'/storage/'.$profile->img);
            }
            $profile->update([
                'img'=>request()->personalPic->store('profile/img','public'),
            ]);

            //====================== Resize without strtch ==============================
            $bg= Image::canvas(300,300);
            $img=Image::make(public_path('storage/'.$profile->img))->resize(300,300,function($c){
                $c->aspectRatio();
                $c->upsize();
            });
            $bg->insert($img,'center');
            $img->save();
        }
    }

    //Get Govs of specafiic country
    public function govsOfCountry(request $request){
        if($request->country){
        $request->validate([
            'country'=>'required|integer|min:0|max:9999'
        ]);
        $countrys=country::where('id',$request->country)->get()->first();
        $govs=$countrys->govs;
        return response()->json(['success'=>'200','govs'=>$govs]);
        }
        return response()->json(['success'=>'404']);
    }
}
