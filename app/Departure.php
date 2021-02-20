<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departure extends Model
{
    protected $table ='departures';

    public function tour()
	{
		return $this->belongsTo('App\Tour', 'tour_id');
	}
    public function scopeFixedDates($query, $id,$month, $year)
    {
        return $query->where('tour_id', '=' , $id )
            -> whereMonth('start','=',$month)
            ->whereYear('start', '=' , $year);
    } 

    public function getStartAttribute($value)
    {
        return  date("jS M, Y", strtotime($value));
    }

    public function getEndAttribute($value)
    {
        return  date("jS M, Y", strtotime($value));
    }    
}
