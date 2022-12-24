<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Block extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'main_blocks';

    public $timestamps = false;

    /**
     * The a
     * @var array
     */
    protected $fillable = ['title', 'link', 'img', 'text', 'type'];

    // return string for index page 
    public function getType() {
        
        $type = null;

        switch ($this->type) {
            case 0:
                $type = 'Головна';
                break;
            case 1:
                $type = 'Стипендіальне забезпечення';
                break;
            case 2:
                $type = 'Карта добрих справ';
                break;
        }

        return $type;
    }

    /**
     * Return path for image or placefolder
     * 
     * @return $path
     */
    public function getPath()
    {
        $path = null;
        if ($this->img) {
            $path = asset('/storage/' . $this->img);
        } else {
            $path = 'https://via.placeholder.com/70';
        }

        return $path;
    }

    /**
     * Scope a query to only include home page inforamtion blocks.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTypeMainInfo($query)
    {
        return $query->where('type', 0);
    }

    /**
     * Scope a query to only include "стипенділальне забезпечення" inforamtion blocks.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTypeSocialInfo($query)
    {
        return $query->where('type', 1);
    }

    public function scopeTypeMapBlock($query)
    {
        return $query->where('type', 2);
    }

    /**
     * Scope a query to only include emploee
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Dtabase\Eloquent\Builder
     */
    public function scopeTypeEmploee($query)
    {
        return $query->where('type', 3);
    }
    
    /**
     * Scope a query to only include information blocks
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInfoBlocks($query)
    {
        return $query->where('type', '!=', 3);
    }

    /**
     * Parse photo in formatt return path and base64
     * 
     * @return array
     */
    public static function parsePhoto($data) { 
        // path to store
        $path = 'uploads/';

        $imageInfo = explode(";base64,", $data);
        $imgExt = str_replace('data:image/', '', $imageInfo[0]);
        $image = str_replace(' ', '+', $imageInfo[1]); 
        $imageName = "emploee-" . time() . "." . $imgExt;
        
        return  [
            'path' => $path . $imageName,
            'base64' => $image
        ];
    }

    public function description()
	{	
		return Str::limit( strip_tags($this->text), 200);
	}
}
