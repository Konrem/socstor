<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Url;
use Jenssegers\Date\Date;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    // Mass assigned
    protected $fillable = ['date', 'title', 'text', 'photo', 'slug', 'published', 'meta_keywords', 'meta_description'];

      // Mutators
    public function setSlugAttribute($value) {
    $this->attributes['slug'] = Str::slug( mb_substr($this->title, 0, 240)  . '-' . date('Y-m-d'));
    }

    // Poly relation with categories
    public function categories(){
        return $this->morphToMany('App\Category', 'categoryable');
    }

    public function photos(){
        return $this->hasMany('App\Photos');
	}
	
	public function seo(){
		return $this->hasMany('App\News', 'news');
	}

    public function scopeLastNew($query, $count) {
      return $query->is_published()->orderBy('created_at', 'desc')->take($count)->get();
  	}

  	/**
   	* Return published status
   	* 
   	* @return String
   	*/
	public function getStatus()
  	{
    	return $this->published == 1 ? 'Опубліковано' : 'Чернетка';
	}
	
	public function description()
	{	
		return html_entity_decode(Str::limit(strip_tags($this->text), 300), ENT_QUOTES, 'UTF-8');
	}
	
	/**
     * Return path for image or placefolder
     * 
     * @return $path
	 */
	public function getPath()
    {
        $path = null;
        if ($this->photo) {
            $path = asset('/storage/' . $this->photo);
        } else {
            $path = 'https://via.placeholder.com/570x380';
        }

        return $path;
	}

	/**
	 * Return month date
	 * 
	 * @return $string
	 */
	public function getMonth()
	{
		Date::setLocale('uk');
		$month = Date::parse($this->created_at)->format('M');

		return Str::title($month);
	}

	/**
	 * Return month date
	 * 
	 * @return $string
	 */

	public function getDay()
	{
		return Date::parse($this->created_at)->format('d');
	}

	/**
	 * Return created date format d m y
	 * 
	 * @return $date
	 */
	public function fullDate()
	{
		return Date::parse($this->created_at)->format('d.m.y');
	}

	/**
	 * Return created date format d F Y
	 * 
	 * @return $date
	 */
	public function fullDateMobile()
	{
		Date::setLocale('uk');
		return Date::parse($this->created_at)->format('d F Y');
	}

	/**
     * Scope a query to only published article
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
	public function scopeIs_published($query)
	{
		return $query->where('published', 1);
	}

	/**
	 * Scope a query to title search or date between
	 * 
	 * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeSearch($query, $string, $searchOf, $searchBy)
	{
		$searchBy = Carbon::parse($searchBy)->endOfDay();
		$tooday = Carbon::now();

		$start = Carbon::parse($searchOf)->startOfDay();

		if ( ($string !== null && $searchOf == null && $searchBy == null) || ($string !== null && $searchOf == null && $searchBy !== null) ) {
			return $query->is_published()->whereBetween('created_at', ['<=', $searchBy])->where('title', 'like', "%$string%");
		} else if ($searchOf == null && $searchBy !== null) {
			return $query->is_published()->where('created_at', '<=', $searchBy);
		} else if ($searchOf !== null && $searchBy == null) {
			return $query->is_published()->where('created_at', $tooday);
		} else if ($searchOf !== null && $searchBy !== null && $string !== null) {
			return $query->is_published()->whereBetween('created_at', [$start, $searchBy])->where('title', 'like', "%$string%");
		} else if ($searchOf !== null && $searchBy !== null) {
			return $query->is_published()->whereBetween('created_at', [$searchOf, $searchBy]);		
		}
	}

	public static function parsePhoto($data) 
    { 
        // path to store
        $path = 'uploads/';

        $imageInfo = explode(";base64,", $data);
        $imgExt = str_replace('data:image/', '', $imageInfo[0]);
        $image = str_replace(' ', '+', $imageInfo[1]); 
        $imageName = "news-" . time() . "." . $imgExt;
        
        return  [
            'path' => $path . $imageName,
            'base64' => $image
        ];
    }
}
