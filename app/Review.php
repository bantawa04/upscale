<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function tour()
    {
        return $this->belongsTo('App\Tour');
    }
    public function scopeApproved($query)
    {
        return $query->where('status', true);
    }
}
