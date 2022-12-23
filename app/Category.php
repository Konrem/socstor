<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Category extends Model
{
    // Mass assigned
    protected $fillable = ['title', 'slug', 'parent_id', 'published', 'created_by', 'modified_by'];
    
    // Mutators
    public function setSlugAttribute($value) {
        $this->attributes['slug'] = Str::slug( mb_substr($this->title, 0, 40));
        // . "-" . \Carbon\Carbon::now()->format('dmyHi'), 
        // '-');
    }

    // public function 
    
    // Get children category
    public function children() {
        return $this->hasMany(self::class, 'parent_id');
    }

    // Morph relation with news
    public function news(){
        return $this->morphedByMany('App\News', 'categoryable');
    }

    public function scopeLastCategories($query, $count) {
        return $query->orderBy('created_at', 'desc')->take($count)->get();
    }
    /**
     * Return status publication
     * 
     * @return String
     */
    public function published()
    {
        return $this->published == 1 ? 'Опубліковано' : 'Не опубліковано';
    }

    
}
