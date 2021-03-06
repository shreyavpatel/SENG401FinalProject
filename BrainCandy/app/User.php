<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function interests(){
        return $this->hasMany(Interest::class);
    }

    public function interestsString(){
        $interests = $this->interests;
        $string = '';
        foreach($interests as $i){
            $string .= $i->interest .=', ';
        }
        $string = rtrim($string,', '); //remove extra ', ' at end
        return $string;
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function youtubeLikes(){
        return $this->likes()->where('platform',0)->get();
    }

    public function flickrLikes(){
        return $this->likes()->where('platform',1)->get();
    }

    public function twitterLikes(){
        return $this->likes()->where('platform',2)->get();
    }

}
