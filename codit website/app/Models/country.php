<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class country extends Model
{
    protected $guarded=[];

    public function govs(){
        return $this->hasMany(\App\Models\gov::class);
    }

    /**
     * Scope filters
     */
    public function scopeUserCountry($quiry){
        return $quiry->where('id',Auth::user()->profile->country);
    }
}
