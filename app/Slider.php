<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Slider extends Model
{
    protected $fillable = ['image', 'description', 'link', 'type'];

    public function setSlugAttribute($value) 
    {
        $this->attributes['link'] = Str::link( mb_substr($this->title, 0, 40));
    }

    public function scopeTypeSlider($query)
    {
        return $query->where('type', 1);
    }

    public function scopeTypePartners($query)
    {
        return $query->where('type', 2);
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

    public function getPath()
    {
        $path = null;
        if ($this->image) {
            $path = asset('/storage/' . $this->image);
        } else {
            $path = 'https://via.placeholder.com/700';
        }

        return $path;
    }
}
