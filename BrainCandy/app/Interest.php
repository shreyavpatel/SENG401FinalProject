<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'interest'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public static function exists($user_id, $interest){
        return (Interest::where('user_id', '=', $user_id)
                    ->where('interest', '=', $interest)
                    ->count() > 0);
    }
}
