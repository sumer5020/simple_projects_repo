<?php

namespace App\Http\Controllers;

use App\Models\chat;
use App\Models\chat_message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
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
            $chats=chat::paginate(20);
            $count=$chats->count();
            $allCount=chat::get()->count();
            return view('components.chatbot.index',compact('chats','count','allCount'));
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
            $chat=new chat();
            return view("components.chatbot.create",compact("chat"));
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
            chat::create($this->validateChat());
            return redirect()->action([ChatController::class, 'index']);
        }
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show(chat $chat)
    {
        return redirect()->action([ChatController::class, 'index']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(chat $chat)
    {
        if(Auth::user()->isAdmin()){
            return view("components.chatbot.edit",compact("chat"));
        }
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, chat $chat)
    {
        if(Auth::user()->isAdmin()){
            $chat->update($this->validateChat());
            return redirect()->action([ChatController::class, 'index']);
        }
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(chat $chat)
    {
        if(Auth::user()->isAdmin()){
            $chat->delete();
            return redirect()->action([ChatController::class, 'index']);
        }
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroySome(Request $request, chat $chat)
    {
        if(Auth::user()->isAdmin()){
            chat::destroy($request->idList);
            return response()->json(['success'=>'200']);
        }
        return redirect('/');
    }

    //Validate chat Data
    public function validateChat(){
        return request()->validate([
            'q'=>'required|string|min:2|max:250',
            'q_ar'=>'required|string|min:2|max:250',
            'answer'=>'required|string|min:2|max:250',
            'answer_ar'=>'required|string|min:2|max:250',
            'status'=>'sometimes|integer|min:0|max:1',
        ]);
    }

    /**
     * send mssages ============================== mex bot with cat_messag
     */
    public function messaging(chat_message $chat_message, Request $request){
        $therIsAdmin=0;
        $data = [];
        $request->validate([
            'message'=>'required|max:500|min:1'
        ]);
        if($request->has('to_id') && Auth::user()->isAdmin()){
            //broadcust Senaryo
            if($request->to_id=='0'){
                foreach((User::Customer()->get()) as $customer){
                    $chat_message->create([
                        'sender_id'=>Auth::user()->id,
                        'receiver_id'=>$customer->id,
                        'message'=>$request->message
                    ]);
                }
            }
            //send one Senaryo
            else{
                chat_message::where('sender_id',$request->to_id)->where('receiver_id',Auth::user()->id)->update(['status' => 1]);
                $chat_message->create([
                    'sender_id'=>Auth::user()->id,
                    'receiver_id'=>$request->to_id,
                    'message'=>$request->message
                ]);
            }

            return response()->json([
                'success'=>'200'
            ]);
        }

        //Filter unmeaning message
        if(strlen($request->message) < 2){
            return response()->json([
                'success'=>'200',
                'data'=>'!'
            ]);
        }

        //chose admin to Answer the clinet
        $admins=User::AllAdmin()->get();
        $chosenAdmin=[];
        foreach($admins as $admin){
            if($admin->isActive()){
                $chosenAdmin=$admin;
                $therIsAdmin=1;
                break;
            }
        }
        if(count($chosenAdmin)==0){
            $chosenAdmin=$admins->first();
        }

        //chick chat bot auto Answers
        $answer = [];
        $AutoAnswer=chat::BotBestAnswer($request->message);
        if($AutoAnswer->first()){
            $answer=$AutoAnswer->first();
            $result=App::getLocale()=='en'?$answer->answer:$answer->answer_ar;
            return response()->json([
                'success'=>'200',
                'data'=>$result
            ]);
        }

        //save the message to message table
        $data=[
            'sender_id'=>Auth::user()->id,
            'receiver_id'=>isset($chosenAdmin->id) ? $chosenAdmin->id : 0,
            'message'=>$request->message,
        ];
        $chat_message->create($data);
        if($therIsAdmin){
            return response()->json([
                'success'=>'201',
            ]);
        }
        return response()->json([
            'success'=>'204',
        ]);
    }
}
