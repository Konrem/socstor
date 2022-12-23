<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SelectPhoto extends Model
{
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image'
    ];

    public function getPath()
    {
        $path = null;
        if ($this->image) {
            $path = asset('/storage/' . $this->image);
        }

        return $path;
    }

    public static function generateNameFile($file) 
    {
        $imageName = date('mdYHis') . uniqid();
        $extension = $file->getClientOriginalExtension();
        $imageFullName = $imageName . '.' . $extension;
        
        return $imageFullName;
    }
}
