<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exclude extends Model
{
	protected $table= 'excludes';
	public $timestamps = false;

    public function tours()
	{
		return $this->belongsToMany('App\Tour');
	}
}
