<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Photos;

class Albums extends Model
{
    protected $fillable = ['title', 'preview'];

    // public function photoes(){
    //     return $this->hasMany('App\Photoes', 'albums_id');
    // }
    // public function toPhotos(){
    //     return $this->hasMany('App\Photos');
    // }
    public function photos(){
        return $this->hasMany('App\Photos');
	}
    
    public function scopeLastAlbums($query, $count) {
        return $query->orderBy('created_at', 'desc')->take($count)->get();
    }
    
    public static function parsePhoto($data) 
    { 
        // path to store
        $path = 'uploads/';

        $imageInfo = explode(";base64,", $data);
        $imgExt = str_replace('data:image/', '', $imageInfo[0]);
        $image = str_replace(' ', '+', $imageInfo[1]); 
        $imageName = "slider-" . time() . "." . $imgExt;
        
        return  [
            'path' => $path . $imageName,
            'base64' => $image
        ];
    }

}
