<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class TourCategory extends Model
{
    protected $table='tourcategories';
    protected $fillable =['name', 'path', 'thumb', 'slug', 'description'];

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

    public function tours()
    {
        return $this->hasMany('App\Tour', 'category_id');
    }    

}
