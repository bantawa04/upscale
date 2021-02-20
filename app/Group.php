<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table= 'groups';

    public function tours()
    {
        return $this->hasMany('App\Tour', 'group_id');
    }    
}
