<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use App\Models\chat_message;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','username', 'email', 'password','phone1','phone2','status','rule'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','status','rule',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Check user ative status
     */
    public function isActive()
    {
        return Cache::has('userActive_'.$this->id);
    }

    /**
     * Check is Admin or souper
     */
    public function isAdmin()
    {
        if($this->rule == 'sprov' || $this->rule == 'prov'){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Check is souper
     */
    public function isSouperAdmin()
    {
        if($this->rule == 'sprov'){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get message count
     */
    public function msgCount()
    {
        $count=chat_message::where('sender_id',$this->id)->where('status',0)->count();
        if($count>0){
            return $count;
        }
        return false;
    }

    /**
     * Scope filters
     */
    public function scopeSouperAdmin($quiry){
        return $quiry->where('rule','sprov');
    }
    public function scopeAdmin($quiry){
        return $quiry->where('rule','prov');
    }
    public function scopeAllAdmin($quiry){
        return $quiry->where('rule','prov')->orwhere('rule','sprov');//->order_by('id', 'ASC');
    }
    public function scopeCustomer($quiry){
        return $quiry->where('rule','customer');
    }

    //relations
    public function portfolios(){
        return $this->belongsToMany(\App\Models\portfolio::class)->withPivot(['rate'])->withTimestamps();
    }
    public function offers(){
        return $this->hasMany(\App\Models\offer::class);
    }
    public function offer_request(){
        return $this->hasMany(\App\Models\offer_request::class);
    }
    public function profile(){
        return $this->hasOne(\App\Models\profile::class);
    }
    public function notifis(){
        return $this->hasMany(\App\Models\notifi::class);
    }
    public function catis(){
        return $this->hasMany(\App\Models\cati::class);
    }
    public function Cards(){
        return $this->hasMany(\App\Models\Card::class);
    }
}
