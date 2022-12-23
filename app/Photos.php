<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
    protected $fillable = ['photo','albums_id','news_id','sliders_id'];

    public $timestamps = false;

    public function getPath()
    {
        $path = null;
        if ($this->photo) {
            $path = asset('/storage/' . $this->photo);
        } else {
            $path = 'https://via.placeholder.com/600x400';
        }

        return $path;
    }
    
    public static function generateNameFile($file) {
        $imageName = date('mdYHis') . uniqid();
        $extension = $file->getClientOriginalExtension();
        $imageFullName = $imageName . '.' . $extension;
        
        return $imageFullName;
    }
    
}
