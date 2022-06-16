<?php

namespace App\Http\Controllers;

use App\Models\chat_message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatMessageController extends Controller
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
            //All Message Count
            $allCount=chat_message::get()->count();
            //All Message paginated
            $messages=chat_message::paginate(20);
            //count message bear paginate
            $count=$messages->count();

            //get all users
            $users=User::get(['id','name']);

            return view('chat.index',compact('messages','count','allCount','users'));
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
        return redirect()->action([ChatMessageController::class, 'index']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->action([ChatMessageController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\chat_message  $chat_message
     * @return \Illuminate\Http\Response
     */
    public function show(chat_message $chat_message)
    {
        return redirect()->action([ChatMessageController::class, 'index']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\chat_message  $chat_message
     * @return \Illuminate\Http\Response
     */
    public function edit(chat_message $chat_message)
    {
        if(Auth::user()->isAdmin()){
            $users=User::get(['id','name']);
            return view('chat.edit',compact('chat_message','users'));
        }
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\chat_message  $chat_message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, chat_message $chat_message)
    {
        if(Auth::user()->isAdmin()){
            $chat_message->update($this->validateChatMessage());
            return redirect()->action([ChatMessageController::class, 'index']);
        }
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\chat_message  $chat_message
     * @return \Illuminate\Http\Response
     */
    public function destroy(chat_message $chat_message)
    {
        if(Auth::user()->isAdmin()){
            $chat_message->delete();
            return redirect()->action([ChatMessageController::class, 'index']);
        }
        return redirect('/');
    }

    /**
     * fresh chat count
     */
    public function freshCounts(chat_message $chat_message, Request $request){
        $side=0;
        $user_msg_count;
        $user_rules;
        $users;

        if(Auth::user()->isAdmin()){
            $users=User::get(['id','name','rule']);

            foreach($users as $user){
                $user_rules[$user->id]=$user->isAdmin();
                $user_msg_count[$user->id]=[
                    'count' => ($user->id!=Auth::user()->id)?$user->msgCount():false
                ];
            }

            $side=chat_message::where('status',0)->whereNotIn('sender_id',User::AllAdmin()->get('id'))->get()->count();
            session()->flash('unAnswersCount',$side);
        }

        return response()->json([
            'success' => '200',
            'side_count' => $side,
            'users' => $users,
            'user_rules' => $user_rules,
            'user_msg_count' => $user_msg_count
        ]);
    }


    /**
     * Dealing with admin to fresh panel chats
     */
    public function Adminfresh(chat_message $chat_message, Request $request){
        $request->validate([
            'after_date' =>'required|date',
            'for_id' =>'required|integer|min:1'
        ]);
        $messages;
        if(Auth::user()->isAdmin()){
        if($request->for_id == Auth::user()->id)
            $messages=chat_message::where('sender_id',$request->for_id)->where('receiver_id',$request->for_id)->where('created_at','>',$request->after_date)->get();
        else
            $messages=chat_message::MessageOfID($request->for_id)->where('created_at','>',$request->after_date)->get();

            chat_message::where('sender_id',$request->for_id)->where('receiver_id',Auth::user()->id)->update(['status' => 1]);

        if(count($messages)>0){
            return response()->json([
                'success'=>'200',
                'data'=>$messages
            ]);
        }
    }

        return response()->json([
            'success'=>'200',
            'data'=>'uptodate'
        ]);
    }

    /**
     * Dealing with clinet to fresh Chat
     */
    public function fresh(chat_message $chat_message, Request $request){
        $messages;
        $request->validate([
            'after_date' =>'required|date'
        ]);
        $messages=chat_message::AuthMessages()->where('sender_id','!=',Auth::user()->id)->where('created_at','>',$request->after_date)->get();
        if(count($messages)>0){
            chat_message::AuthMessages()->where('sender_id','!=',Auth::user()->id)->update(['status' => 1]);
            return response()->json([
                'success'=>'200',
                'data'=>$messages
            ]);
        }
        return response()->json([
            'success'=>'200',
            'data'=>'uptodate'
        ]);
    }


    /**
     * get chat message of id for admin
     */
    public function getIdMessage(chat_message $chat_message, Request $request){
        $messages;
        $request->validate([
            'user_id' => 'required|integer|min:0'
        ]);
        if(Auth::user()->isAdmin()){
            if(Auth::user()->id == $request->user_id){
            //count all unanswers
            $allCount=chat_message::where('sender_id',$request->user_id)->where('receiver_id',$request->user_id)->get()->count();
            if($allCount>20)
            $messages=chat_message::where('sender_id',$request->user_id)->where('receiver_id',$request->user_id)->skip($allCount-20)->take(20)->get();
            else
            $messages=chat_message::where('sender_id',$request->user_id)->where('receiver_id',$request->user_id)->get();
            }else{
                //count all unanswers
            $allCount=chat_message::AuthMessages()->MessageOfID($request->user_id)->get()->count();
            if($allCount>20)
            $messages=chat_message::AuthMessages()->MessageOfID($request->user_id)->skip($allCount-20)->take(20)->get();
            else
            $messages=chat_message::AuthMessages()->MessageOfID($request->user_id)->get();
            }
        }
        return response()->json([
            'success'=>'200',
            'data'=>$messages
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\chat_message  $chat_message
     * @return \Illuminate\Http\Response
     */
    public function destroySome(Request $request, chat_message $chat_message)
    {
        if(Auth::user()->isAdmin()){
            chat_message::destroy($request->idList);
            return response()->json(['success'=>'200']);
        }
        return redirect('/');
    }

    //Validate chat Data
    public function validateChatMessage(){
        return request()->validate([
            'sender_id'=>'required|integer|min:1',
            'receiver_id'=>'required|integer|min:1',
            'message'=>'required|string|min:2|max:500',
            'status'=>'sometimes|integer|min:0',
        ]);
    }
}
