<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'types';

    public function team()
    {
        return $this->hasMany('App\Team', 'type_id');
    }
}
