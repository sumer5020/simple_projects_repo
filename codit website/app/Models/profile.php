<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    protected $guarded=[];
    public function user(){
        return $this->belongsToOne(\App\Models\User::class);
    }

}
