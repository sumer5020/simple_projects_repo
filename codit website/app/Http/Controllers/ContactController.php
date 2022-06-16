<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\follow;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index','store','addfollow');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contact.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $data=$this->validateContact();
        session()->flash('success','200');

        if(session()->has('lastMessage')){
            if(md5($data['message']) == session()->get('lastMessage')){
                return back();
            }
        }
        //send email here
        session()->put('lastMessage',md5($data['message']));
        mail::to('sumer5020@outlook.com')->bcc('sumer5020@gmail.com')->send(new \App\Mail\contact($data));
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addfollow(Request $request, follow $follow){
        $data=$request->validate([
            'email'=>'required|string|email|min:7|max:30'
        ]);

        if(follow::where('email',$data['email'])->count()){
            return response()->json(['success'=>'201']);
        }
        //follow message
        $follow->create($data);
        return response()->json(['success'=>'200']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return back()?back():redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return back()?back():redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        return back()?back():redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return back()?back():redirect('/');
    }

    //validate cobtact forms
    public function validateContact(){
        return request()->validate([
            'name'=>'required|string|min:2|max:30',
            'email'=>'required|email|min:9|max:30',
            'subject'=>'required|string|max:30',
            'message'=>'required|string|max:500',
        ]);
    }
}
