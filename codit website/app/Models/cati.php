<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cati extends Model
{
    protected $guarded=[];

    public function user(){
        return $this->belongsTo(\App\Models\User::class);
    }
    public function offers(){
        return $this->hasMany(\App\Models\offer::class);
    }
    public function portfolios(){
        return $this->hasMany(\App\Models\portfolio::class);
    }
}
