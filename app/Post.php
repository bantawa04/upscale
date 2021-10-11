<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Post extends Model
{
    protected $table='posts';
    protected $guarded = [];
    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
        
    }

    public function category()
    {
        return $this->belongsTo('App\BlogCategory', 'category_id')->withDefault();
    }    

    public function tags()
    {
    	return $this->belongsToMany('App\Tag');
    }

    public function metaImage($tag){
        return str_replace('tr:n-blogThumb', $tag, $this->path);
    }
}
