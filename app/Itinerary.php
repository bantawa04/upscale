<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    protected $table ='itineraries';
    protected $casts = [
        'day' => 'integer',
    ];

    public function getTax($value)
    {
        return (int) $value;
    }
    public function tour() 
    {
        return $this->belongsTo('App\Tour', 'tour_id');
    }
}
