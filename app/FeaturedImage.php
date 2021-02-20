<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeaturedImage extends Model
{
    protected $table ='featured_image';
    protected $fillable = ['path','thumb', 'name','tour_id'];
    public function tour()
    {
        return $this->belongsTo('App\Tour');
    }
}
