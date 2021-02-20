<?php

use Illuminate\Database\Seeder;
use App\Tour;

class AttributeTableSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tours = Tour::all();
        foreach ($tours as $item) {
            $item->rating_count = rand(8,12);
            $item->rating_cache = rand(43,50)/10;
            $item->save();
        }
    }
    
}
