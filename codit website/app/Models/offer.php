<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class offer extends Model
{
    protected $guarded=[];

    /**
     * Scope filters
     */
    public function scopeIsStart($quiry){
        return $quiry->where('start_at','<=',Carbon::now())->orderBy('start_at', 'ASC');
    }

    public function scopeIsOn($quiry){
        return $quiry->where('status',1)->where('end_at','>',Carbon::now());
    }

    //relations
    public function user(){
        return $this->belongsTo(\App\Models\User::class);
    }

    public function cati(){
        return $this->belongsTo(\App\Models\cati::class);
    }

    public function offer_request(){
        return $this->hasMany(\App\Models\offer_request::class);
    }

    //Auto setting
    public function __destruct()
    {
        //check the expire date and change status this work before end row
        if(Carbon::now() >= $this->end_at ){
            $this->update([
                'status'=>0
            ]);
        }
    }
}
