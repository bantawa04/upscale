<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    protected $table= 'carousels';
    protected $fillable = ['fileID','url','thumb', 'name'];
}
