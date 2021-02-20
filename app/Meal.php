<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $table = 'meals';

    public function tours()
    {
        return $this->hasMany('App\Tour', 'meal_id');
    }    
    
}
