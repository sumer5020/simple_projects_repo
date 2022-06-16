<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class chat extends Model
{
    protected $guarded=[];

    public function user(){
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Scope filters
     */
    public function scopeBotBestAnswer($quiry,$q){
        return $quiry->where('q','LIKE','%'.$q.'%')->orwhere('q_ar','LIKE','%'.$q.'%')->where('status',1);//->order_by('id', 'DESC');
    }

}
