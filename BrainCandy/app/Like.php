<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'item', 'platform'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getYoutubeTitle(){
        if($this->platform!=0) return null;
        // https://stackoverflow.com/questions/1216029/get-title-from-youtube-videos
        $content = file_get_contents("http://youtube.com/get_video_info?video_id=".$this->item);
        parse_str($content, $ytarr);
        return $ytarr['title'];
    }
}
