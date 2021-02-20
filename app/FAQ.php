<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    protected $table = 'f_a_q_s';
    protected $guarded = [];
    public function tours()
    {
        return $this->belongsTo('App\Tour', 'tour_id');
    }
}
