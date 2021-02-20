<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Difficulty extends Model
{
    protected $table = 'difficulties';

    public function tours()
    {
        return $this->hasMany('App\Tour', 'difficulty_id');
    }    
}
