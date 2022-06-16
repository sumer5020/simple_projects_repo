<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class chat_message extends Model
{
    protected $guarded=[];

    /**
     * Scope filters
     */
    public function scopeAuthMessages($quiry){
        return $quiry->where('sender_id',Auth::user()->id)->orwhere('receiver_id',Auth::user()->id)->orderBy('id', 'ASC');
    }
    public function scopeNotAnswered($quiry){
        return $quiry->where('status',0)->orderBy('id', 'ASC');
    }
    public function scopeMessageOfID($quiry,$id){
        return $quiry->where('sender_id',$id)->orwhere('receiver_id',$id)->orderBy('id', 'ASC');
    }

    /**
     * Check is Answerd or not
     */
    public function isAnswered()
    {
        if($this->status == 0){
            return false;
        }else{
            return true;
        }
    }
}
