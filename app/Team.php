<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function type()
    {
        return $this->belongsTo('App\Type', 'type_id');
    }

}
