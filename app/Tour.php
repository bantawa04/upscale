<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use DB;

class Tour extends Model
{
    protected $table='tours';
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
    public function country()
    {
        return $this->belongsTo('App\Country', 'country_id')->withDefault();
    }

    public function category()
    {
        return $this->belongsTo('App\TourCategory', 'category_id')->withDefault();
    }
    public function meal() //Works perfectly
    {
        return $this->belongsTo('App\Meal')->withDefault();
    }
    public function group() //Works perfectly
    {
        return $this->belongsTo('App\Group')->withDefault();
    }
    public function difficulty() //Works perfectly
    {
        return $this->belongsTo('App\Difficulty')->withDefault();
    }
    public function region()  //Works perfectly
    {
        return $this->belongsTo('App\Region')->withDefault();
    }
    public function accomodation() //Works perfectly
    {
        return $this->belongsTo('App\Accomodation')->withDefault();
    }
    public function includes()
    {
        return $this->belongsToMany('App\Includes','includes_tour', 'tour_id', 'included_id')->orderBy('name', 'asc');
    }
    public function excludes()
    {
        return $this->belongsToMany('App\Exclude','excludes_tour', 'tour_id', 'excluded_id')->orderBy('name', 'asc');
    }
    public function image()
    {
        return $this->hasOne('App\FeaturedImage');
    }
    public function departure()
    {
        return $this->hasMany('App\Departure', 'tour_id');
    }
    public function itinerary()
    {
        return $this->hasMany('App\Itinerary', 'tour_id')->orderByRaw('CONVERT(day, UNSIGNED) ASC');
    }
    public function slides()
    {
        return $this->hasMany('App\Slide', 'tour_id');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }    
    
    public function recalculateRating($rating)
    {
        $reviews = $this->reviews()->approved();
        $avgRating = $reviews->avg('rating');
        $this->rating_cache = round($avgRating,1);
        $this->rating_count = $reviews->count();
        $this->save();
    }     

    public function location()
    {
        return $this->belongsTo('App\Location', 'start', 'id')->withDefault();
    }
    public function locationEnd()
    {
        return $this->belongsTo('App\Location', 'end', 'id')->withDefault();
    }    

    public function faq()
    {
        return $this->hasMany('App\FAQ', 'tour_id');
    }  

    public function elevation(){
        return $this->max_altitude."m /".$this->max_altitude* 3.281. " .ft";
    }

    // public function getMaxAltitudeAttribute($value)
    // {
    //     return $value."m / ".$value* 3.281." .ft";
    // }

    public function getImage($tag){
        $url = $this->slides[0]->path;
        return str_replace('tr:n-tSlide',$tag, $url);
    }
}
