<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accomodation extends Model
{
    protected $table= 'accomodations';

    public function tours()
    {
        return $this->hasMany('App\Tour', 'accomodation_id');
    }    
}
