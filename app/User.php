<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone','speciality_id','doctype'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     public static function boot(){
        parent::boot();

        static::creating(function ($user){
            $user->token = str_random(40);
        });
    }

    public function hasVerified(){
        $this->verified = true;
        $this->token = null;

        $this->save();
    }

     public function clinics(){
        return $this->belongsToMany('App\Clinic');
    }

    public function roles(){
        return $this->belongsToMany('App\Role');
    }

   public function visits(){
        return $this->hasMany('App\Visit');
   }

    public function speciality(){
        return $this->belongsTo('App\Speciality');
    }

    public function medicines(){
        return $this->hasMany('App\Medicine');
    }

    public function pathologies(){
        return $this->hasMany('App\Pathology');
    }

       public function templates(){
        return $this->hasMany('App\Template');
   }

}
