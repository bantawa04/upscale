<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Country extends Model
{
    use Sluggable;
    protected $table = 'countries';

    protected $fillable = ['name', 'description', 'path', 'thumb','map', 'fileID'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
        
    }    

    public function tours()
    {
        return $this->hasMany('App\Tour', 'country_id');
    }   
    
}
