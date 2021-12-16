<?php

namespace App\Http\Controllers;

use App\BlogCategory;
use Illuminate\Http\Request;
use App\Carousel;
use App\Country;
use App\Departure;
use App\Difficulty;
use App\Page;
use App\Team;
use App\TourCategory;
use App\Type;
use App\Tour;
use App\Setting;
use App\Post;
use App\Region;
use App\Traits\MetaTag;
use Illuminate\Support\Facades\View;

class FrontendController extends Controller
{
    use MetaTag;
    public function __construct()
    {
        $setting = Setting::firstOrFail();
       $metaImages = (object) [
            'ogTag' => str_replace(env('IMAGE_KIT_URL'), env('IMAGE_KIT_URL') . '/tr:n-OGTag', $setting->cover),
            'twitter' => str_replace(env('IMAGE_KIT_URL'), env('IMAGE_KIT_URL') . '/tr:n-twitter', $setting->cover)
        ];

        $this->carousels = Carousel::all();
        $this->categories = TourCategory::whereHas('tours')->get();
        $this->countries = Country::all();
        $this->difficulties = Difficulty::all();
        View::share('metaImages', $metaImages);
    }
    // Home version 1

    public function index()
    {
        $featureds = Tour::where('status', 1)->where('featured', 1)->get();
        $posts = Post::where('status', true)->latest()->take(3)->get();
        return view('frontend.home-2')
            ->withCarousels($this->carousels)
            ->withCategories($this->categories)
            ->withFeatureds($featureds)
            ->withPosts($posts);
    }

    // Home version 2
    public function home2()
    {
        return view('frontend.home')
            ->withCarousels($this->carousels)
            ->withCategories($this->categories);
    }

    public function search(Request $request)
    {

        $query = Tour::query();

        if (!empty($request->country)) {
            $query = $query->whereHas('country', function ($r) use ($request) {
                $r->where('countries.slug', $request->country);
            });
        }
        if (!empty($request->category)) {
            $query = $query->whereHas('category', function ($s) use ($request) {
                $s->whereIn('tourcategories.slug', $request->category);
            });
        }
        if (!empty($request->difficulty)) {
            $query = $query->whereHas('difficulty', function ($s) use ($request) {
                $s->where('difficulties.name', $request->difficulty);
            });
        }
        if (!empty($request->price_min) || !empty($request->price_max)) {
            $query = $query->whereBetween('price', [$request->price_min, $request->price_max]);
        }

        $collection = $query->where('status', '=', 1)->where('name', 'LIKE', '%' . $request->q . '%')
            ->paginate(10);

        return view('frontend.search')
            ->withCategories($this->categories)
            ->withCountries($this->countries)
            ->withDifficulties($this->difficulties)
            ->withResults($collection);
    }

    public function tripDetail($slug)
    {
        $tour = Tour::where('slug', '=', $slug)->first();
        $tour->ogTag = $tour->getImage('n-OGTag');
        $tour->twitterImg = $tour->getImage('n-twitter');
        $cat = $tour->category->slug;
        $similars = Tour::whereHas('category', function ($r) use ($cat) {
            $r->where('tourcategories.slug', '=', $cat);
        })
            ->where('status', 1)
            ->whereNotIn('id', [$tour->id])
            ->orderByRaw('RAND()')
            ->take(3)
            ->get();

        $departures = Departure::where('tour_id', '=', $tour->id)
            ->whereMonth('start', '=', '01')
            ->whereYear('start', '=', '2020')
            ->get();

        return view('frontend.trip-detail')
            ->withTour($tour)
            ->withSimilars($similars)
            ->withDepartures($departures);
    }

    public function contact()
    {
        $setting = Setting::firstOrFail();
        return view('frontend.contact')->withSetting($setting);
    }

    public function getAbout()
    {
        $about = Page::where('slug', '=', 'about-us')->orWhere('slug', '=', 'about')->firstOrFail();
        $types  = Type::all();
        return view('frontend.about-us')
            ->withPage($about)
            ->withTcategories($types);
    }


    public function thankYou()
    {
        return view('frontend.thank-you');
    }

    // public function lead(){
    //     return view('frontend.lead');
    // }      

    public function blogPosts()
    {
        $posts = Post::where('status', '=', 1)
            ->where('featured', '=', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(3);

        $featured = Post::where('status', '=', 1)
            ->where('featured', '=', 1)
            ->first();

        return view('frontend.post-list')
            ->withFeatured($featured)
            ->withPosts($posts)
            ->withTitle(0);
    }
    public function singlePost($category, $slug)
    {
        $post = Post::whereHas('category', function ($r) use ($category) {
            $r->where('blogCateogries.slug', '=', $category);
        })
            ->where('slug', '=', $slug)->first();
        $post->ogTag = $post->metaImage('n-OGTag');
        $post->twitter = $post->metaImage('n-twitter');
        return view('frontend.post-detail')->withPost($post);
    }
    public function postByCategory($slug)
    {
        $posts = Post::whereHas('category', function ($r) use ($slug) {
            $r->where('blogCateogries.slug', '=', $slug);
        })
            ->where('status', '=', 1)
            ->paginate(10);
        $category = BlogCategory::where('slug', $slug)->first();
        return view('frontend.post-list')
            ->withPosts($posts)
            ->withTitle(1)
            ->withCategory($category);
    }

    public function allDestination()
    {
        return view('frontend.destinations')
            ->withCountries($this->countries);
    }

    public function country($slug)
    {
        $country = Country::where('slug', '=', $slug)->firstOrFail();
        $tours = $country->tours()->with('category')->get(['category_id']);
        $categories = $tours->pluck('category')->unique();
        return view('frontend.country')
            ->withCountry($country)
            ->withCategories($categories);
    }

    public function countryCategory($country, $cat)
    {
        // return 1;
        $stuff = $this->metaTag($country, $cat);
        $category = TourCategory::where('slug', $cat)->first();
        $results = Tour::whereHas('category', function ($r) use ($cat) {
            $r->where('tourcategories.slug', $cat);
        })
            ->whereHas('country', function ($s) use ($country) {
                $s->where('countries.slug', $country);
            })
            ->get();

        return view('frontend.category-country')
            ->withResults($results)
            ->withCategory($category)
            ->withStuff($stuff);
    }

    public function allActivities()
    {
        $cats = TourCategory::whereHas('tours')->get();

        return view('frontend.category')
            ->withCategories($cats);
    }

    public function byCategory($category)
    {
        $cateogry = TourCategory::where('slug', '=', $category)->firstOrFail();
        $results = Tour::whereHas('category', function ($r) use ($category) {
            $r->where('tourcategories.slug', $category);
        })
            ->where('status', '=', 1)
            ->get();
        $title_tag = "Trips available for " . ucfirst($category);
        return view('frontend.category-with-trips')
            ->withResults($results)
            ->withCategory($cateogry)
            ->withTitle($title_tag);
    }

    public function getPromotedPackages()
    {
        $tours = Tour::where('status', '=', 1)
            ->where('promote', '=', 1)
            ->get();

        return view('frontend.lead')
            ->withTours($tours);
    }
    public function ajaxDepartures(Request $request)
    {
        $departures = Departure::where('tour_id', '=', $request->tour_id)
            ->whereYear('start', '=', $request->year)
            ->whereMonth('start', '=', $request->month)
            ->get();
        return view('frontend.partials._dates')->withDepartures($departures);
    }

    public function booking(Request $request, $slug)
    {
        $tour = Tour::where('slug', '=', $slug)->first();
        $departure = Departure::where('id', '=', $request->depID)->first();
        return view('frontend.booking')
            ->withDeparture($departure)
            ->withTour($tour);
    }

    public function getPage($slug)
    {
        $page = Page::where('slug', '=', $slug)->firstOrFail();
        return view('frontend.page')->withPage($page);
    }

    public function categoryRegion($category, $region)
    {
        $stuff = $this->metaTag($category, $region);
        $region = Region::where('slug', '=', $region)->first();
        $tours = Tour::whereHas('category', function ($r) use ($category) {
            $r->where('tourcategories.slug', $category);
        })
            ->whereHas('region', function ($s) use ($region) {
                $s->where('regions.slug', $region->slug);
            })
            ->get();
        return view('frontend.category-region')
            ->withRegion($region)
            ->withResults($tours)
            ->withMeta($stuff);
    }

    public function getPackages()
    {
        $tours = Tour::where('status', 1)->paginate(12);
        return view('frontend.packages')->withResults($tours);
    }

    public function planTrip()
    {
        $tours = Tour::where('status', 1)->get();
        return view('frontend.planTrip')->withTours($tours);
    }  

}
