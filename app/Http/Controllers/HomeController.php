<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tours = DB::table('tours')->count();
        $countries = DB::table('countries')->count();
        $tcategories = DB::table('tourcategories')->count();
        $regions = DB::table('regions')->count();
        $pages = DB::table('pages')->count();
        $posts = DB::table('posts')->count();
        $bcategories = DB::table('blogCateogries')->count();
        $tags = DB::table('tags')->count();
        return view('home')
        ->withTours($tours)
        ->withCountries($countries)
        ->withTcategories($tcategories)
        ->withRegions($regions)
        ->withPages($pages)
        ->withPosts($posts)
        ->withBcategories($bcategories)
        ->withTags($tags);
    }
}
