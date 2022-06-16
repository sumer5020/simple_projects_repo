<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class portfolio extends Model
{
    protected $guarded=[];

    //relations
    public function users(){
        return $this->belongsToMany(\App\Models\portfolio::class)->withPivot(['rate'])->withTimestamps();
    }
    public function cati(){
        return $this->belongsTo(\App\Models\cati::class);
    }

    //scope filter
    public function scopeIsOn($quiry){
        return $quiry->where('status',1);
    }
}
