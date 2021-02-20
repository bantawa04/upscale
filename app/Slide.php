<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $table ='slides';
    
    protected $fillable = ['path', 'thumb','name','media_id'];
	public function tour()
	{
		return $this->belongsTo('App\Tour', 'tour_id');
	}
}
