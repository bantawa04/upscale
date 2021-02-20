<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Includes extends Model
{
	protected $table = 'includes';
	public $timestamps = false;

    public function tours()
	{
		return $this->belongsToMany('App\Tour');
	}
}
