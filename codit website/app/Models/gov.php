<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class gov extends Model
{
    protected $guarded=[];

    public function country(){
        return $this->belongsTo(\App\Models\country::class);
    }

    /**
     * Scope filters
     */
    public function scopeUserGov($quiry){
        return $quiry->where('id',Auth::user()->profile->gov);
    }
}
