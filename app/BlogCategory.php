<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class BlogCategory extends Model
{
    protected $table = 'blogCateogries';

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
                'source' => 'name'
            ]
        ];
        
    }

    public function post()
    {
        return $this->hasMany('App\Post', 'post_id');
    }       

}
