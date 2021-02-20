<?php

namespace App\Http\Utilities;

use App\TourCategory;
use App\Region;
use App\Setting;
use App\Page;
use App\Tour;
use App\Recommended;
use Illuminate\Contracts\View\View;

class NavComposer
{

	public function footer(View $view)
	{
		$setting = Setting::firstOrFail();
		if ($setting) {
			$view->withSetting($setting);
		}

		$recommendeds = Recommended::all();
		$view->withRecommendeds($recommendeds);

		$categories = TourCategory::whereHas('tours')->get();
		$view->withCategories($categories);

		$left = Page::where('position', 1)->where('status', 1)->orderBy('position', 'asc')->get();
		$view->withLeft($left);
		
		$right = Page::where('position', 2)->where('status', 1)->orderBy('position', 'asc')->get();
		$view->withRight($right);
	}

	public function menu(View $view)
	{
		// Nepal
			// Trekking
				// Annpurna Region
		$as = Tour::whereHas('category', function($r){
			$r->where('tourcategories.slug','trekking');
		})
		->whereHas('region', function($r){
			$r->where('regions.slug','annapurna-region');
		})
		->whereHas('country', function($r){
			$r->where('countries.slug','nepal');
		})
		->where('status',1)->get();
		$view->withAs($as);

				//Everest Region
		$es = Tour::whereHas('category', function($r){
			$r->where('tourcategories.slug','trekking');
		})
		->whereHas('region', function($r){
			$r->where('regions.slug','everest-region');
		})
		->whereHas('country', function($r){
			$r->where('countries.slug','nepal');
		})
		->where('status',1)->get();
		$view->withEs($es);		
		
				//Langang Region
		$ls = Tour::whereHas('category', function($r){
			$r->where('tourcategories.slug','trekking');
		})
		->whereHas('region', function($r){
			$r->where('regions.slug','langtang-region');
		})
		->whereHas('country', function($r){
			$r->where('countries.slug','nepal');
		})
		->where('status',1)->get();
		$view->withLs($ls);	
		
					//Manaslu Region
		$ms = Tour::whereHas('category', function($r){
			$r->where('tourcategories.slug','trekking');
		})
		->whereHas('region', function($r){
			$r->where('regions.slug','manaslu-region');
		})
		->whereHas('country', function($r){
			$r->where('countries.slug','nepal');
		})
		->where('status',1)->get();
		$view->withMs($ms);		
		
					//off-beaten-path
		$off = Tour::whereHas('category', function($r){
			$r->where('tourcategories.slug','trekking');
		})
		->whereHas('region', function($r){
			$r->where('regions.slug','off-beaten-path');
		})
		->whereHas('country', function($r){
			$r->where('countries.slug','nepal');
		})
		->where('status',1)->get();
		$view->withOff($off);		
		
		//Climbing

		$climb = Tour::whereHas('category', function($r){
			$r->where('tourcategories.slug', 'climbing');
		})
		->where('status', 1)
		->get();
		$view->withClimb($climb);

		//Excursion

		$ex = Tour::whereHas('category', function($r){
			$r->where('tourcategories.slug', 'excursion');
		})
		->whereHas('country', function($r){
			$r->where('countries.slug', 'nepal');
		})
		->where('status', 1)
		->get();
		$view->withEx($ex);		

		
		//Nature & wildlife

		$na = Tour::whereHas('category', function($r){
			$r->where('tourcategories.slug', 'nature-wildlife');
		})
		->where('status', 1)
		->get();
		$view->withNa($na);

		//Bhutan
		$bhutan = Tour::whereHas('country', function($r){
			$r->where('countries.slug', 'bhutan');
		})
		->where('status', 1)
		->get();
		$view->withBhutan($bhutan);		

		//Tibet
		$tibet = Tour::whereHas('country', function($r){
			$r->where('countries.slug', 'tibet');
		})
		->where('status', 1)
		->get();
		$view->withTibet($tibet);	

		//Tibet
		$ht = Tour::whereHas('category', function($r){
			$r->where('tourcategories.slug', 'heli-tour');
		})
		->where('status', 1)
		->get();
		$view->withHt($ht);			
	}

}
