<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'keywords',
        'telephone',
        'address',
        'instagram',
        'i_description',
        'facebook',
        'f_description',
        'youtube',
        'email',
        'e_description'
    ];

    public $timestamps = false;

}
