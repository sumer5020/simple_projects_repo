<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class offer_request extends Model
{

    protected $guarded=[];

    //relations
    public function user(){
        return $this->belongsTo(\App\Models\User::class);
    }

    public function offer(){
        return $this->belongsTo(\App\Models\offer::class);
    }
}
