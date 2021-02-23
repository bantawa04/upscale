<?php

namespace App\Http\Controllers;

use App\Tour;
use Illuminate\Http\Request;
use App\Media;
use App\UploadManager;
use App\Accomodation;
use App\Meal;
use App\Country;
use App\TourCategory;
use App\Region;
use App\Group;
use App\Difficulty;
use App\Includes;
use App\Exclude;
use App\FeaturedImage;
use App\Slide;
use App\Location;
use App\Traits\SelectOption;

class TourController extends Controller
{

    use SelectOption;

    public function __construct()
    {
        $this->difficulties = $this->selectOption(Difficulty::all());
        $this->groups = $this->selectOption(Group::all());
        $this->categories = $this->selectOption(TourCategory::all());
        $this->regions = $this->selectOption(Region::all());
        $this->accomodations = $this->selectOption(Accomodation::all());
        $this->meals = $this->selectOption(Meal::all());
        $this->includes = $this->selectOption(Includes::all());
        $this->excludes = $this->selectOption(Exclude::all());
        $this->images = Media::latest()->get();
        $this->countries = $this->selectOption(Country::all());
        $this->locations = $this->selectOption(Location::all());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tours = Tour::all();
        return view('backend.tour.index')->withTours($tours);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.tour.create')
            ->withDifficulties($this->difficulties)
            ->withAccomodations($this->accomodations)
            ->withMeals($this->meals)
            ->withCountries($this->countries)
            ->withCategories($this->categories)
            ->withRegions($this->regions)
            ->withIncludes($this->includes)
            ->withExcludes($this->excludes)
            ->withGroups($this->groups)
            ->withLocations($this->locations)
            ->withImages($this->images);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required|required',
            'days' => 'required|numeric',
            'price' => 'required|numeric',
            'max_altitude' => 'required|numeric',
            'days' => 'required|numeric',
            'difficulty' => 'required',
            'group' => 'required',
            'accomodation' => 'required',
            'meal' => 'required',
            'country' => 'required',
            'category' => 'required',
            'overview' => 'required',
            'featured' => 'required',
            'slides' => 'required|array',
            'meta_title' => 'required',
            'meta_description' => 'required'
        ]);
        $tour = new Tour;
        $tour->name = $request->name;
        $tour->days = $request->days;
        $tour->price = $request->price;
        $tour->discountPrice = $request->discountPrice;
        $tour->max_altitude = $request->max_altitude;
        $tour->difficulty_id = $request->difficulty;
        $tour->meal_id = $request->meal;
        $tour->group_id = $request->group;
        $tour->accomodation_id = $request->accomodation;
        $tour->country_id = $request->country;
        $tour->category_id = $request->category;
        $tour->region_id = $request->region;
        $tour->start = $request->start;
        $tour->end = $request->end;
        $tour->difficulty_id = $request->difficulty;
        $tour->overview = $request->overview;
        $tour->note = $request->note;
        $tour->title = $request->title;
        $tour->meta_title = $request->meta_title;
        $tour->meta_description = $request->meta_description;
        $tour->save();

        if (!empty($request->featured)) {
            $image = Media::findOrFail($request->featured);
            $path = UploadManager::fromMedia($image->path, 1024, 512, "tou_");
            $thumb = UploadManager::fromMedia($image->path, 400, 300, "tou_thumb_");
            $tour->image()->save(new FeaturedImage([
                'path' => $path,
                'thumb' => $thumb
            ]));
        }

        if (!empty($request->slides)) {
            $medias = Media::whereIn('id', $request->slides)->get();
            foreach ($medias as $media) {
                $slide = new Slide;
                $slide->tour_id = $tour->id;
                $slide->media_id = $media->id;
                $slide->path = UploadManager::fromMedia($media->path, 1920, 1080, "slide_");
                $slide->thumb = UploadManager::fromMedia($media->path, 375, 563, "slide_thumb_");
                $slide->name = $media->name;
                $slide->save();
            }
        }


        if (isset($request->includes)) {
            $tour->includes()->sync($request->includes, false);
        }
        if (isset($request->excludes)) {
            $tour->excludes()->sync($request->excludes, false);
        }
        return redirect()->route('tour.show', $tour->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function show(Tour $tour)
    {
        return view('backend.tour.show')->withTour($tour);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function edit(Tour $tour)
    {
        return view('backend.tour.edit')
            ->withDifficulties($this->difficulties)
            ->withAccomodations($this->accomodations)
            ->withMeals($this->meals)
            ->withCountries($this->countries)
            ->withCategories($this->categories)
            ->withRegions($this->regions)
            ->withIncludes($this->includes)
            ->withExcludes($this->excludes)
            ->withGroups($this->groups)
            ->withImages($this->images)
            ->withLocations($this->locations)
            ->withTour($tour);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tour $tour)
    {
        $this->validate($request, [
            'name' => 'required|required',
            'days' => 'required|numeric',
            'price' => 'required|numeric',
            'max_altitude' => 'required|numeric',
            'days' => 'required|numeric',
            'difficulty_id' => 'required',
            'group_id' => 'required',
            'accomodation_id' => 'required',
            'meal_id' => 'required',
            'country_id' => 'required',
            'category_id' => 'required',
            'overview' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required'
        ]);
        $tour->name = $request->name;
        $tour->days = $request->days;
        $tour->price = $request->price;
        $tour->discountPrice = $request->discountPrice;
        $tour->max_altitude = $request->max_altitude;
        $tour->difficulty_id = $request->difficulty_id;
        $tour->meal_id = $request->meal_id;
        $tour->group_id = $request->group_id;
        $tour->accomodation_id = $request->accomodation_id;
        $tour->country_id = $request->country_id;
        $tour->category_id = $request->category_id;
        $tour->region_id = $request->region_id;
        $tour->start = $request->start;
        $tour->end = $request->end;
        $tour->difficulty_id = $request->difficulty_id;
        $tour->overview = $request->overview;
        $tour->note = $request->note;
        $tour->title = $request->title;
        $tour->meta_title = $request->meta_title;
        $tour->meta_description = $request->meta_description;
        $tour->save();

        if (!empty($request->featured)) {
            $oldImage = $tour->image->path;
            $oldThumb = $tour->image->thumb;

            $image = $tour->image;

            $media = Media::findOrFail($request->featured);
            $image->path = UploadManager::fromMedia($media->path, 1024, 512, "tou_");
            $image->thumb = UploadManager::fromMedia($media->path, 400, 300, "tou_thumb_");

            $tour->image()->save($image);

            @unlink($oldImage);
            @unlink($oldThumb);
        }

        if (isset($request->slides)) {
            $oldIds = Slide::where('tour_id', '=', $tour->id)->get();
            $oldIds->whenNotEmpty(function ($oldIds) {
                foreach ($oldIds as $oldId) {
                    @unlink($oldId->path);
                    @unlink($oldId->thumb);
                    $oldId->delete();
                }
            });
            $medias = Media::whereIn('id', $request->slides)->get();
            foreach ($medias as $media) {
                $slide = new Slide;
                $slide->tour_id = $tour->id;
                $slide->media_id = $media->id;
                $slide->path = UploadManager::fromMedia($media->path, 1920, 1080, "slide_");
                $slide->thumb = UploadManager::fromMedia($media->path, 375, 563, "slide_thumb_");
                $slide->name = $media->name;
                $slide->save();
            }
        }


        if (isset($request->includes)) {
            $tour->includes()->sync($request->includes);
        }
        if (isset($request->excludes)) {
            $tour->excludes()->sync($request->excludes);
        }
        return redirect()->route('tour.show', $tour->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tour = Tour::find($id);
        // foreach ($tour->departure as $departure) {
        //     $departure->delete();
        // }
        if ($tour->image) {
            @unlink($tour->image->thumb);
            @unlink($tour->image->banner);
            $tour->image->delete();
        }
        foreach ($tour->slides as $slide) {
            @unlink($slide->path);
            @unlink($slide->thumb);
            $slide->delete();
        }
        if ($test = $tour->includes()->count() != null) {
            $tour->includes()->detach();
        }
        if ($test = $tour->excludes()->count() != null) {
            $tour->excludes()->detach();
        }
        $tour->delete();

        return ['type' => 'info', 'message' => 'Tour deleted sucessfully.'];
    }

    public function publish($id)
    {
        $tour = Tour::find($id);
        $tour->status = 1;
        $tour->save();
        return ['type' => 'success', 'message' => 'Tour published'];
    }

    public function unpublish($id)
    {
        $tour = Tour::find($id);
        $tour->status = 0;
        $tour->save();
        return ['type' => 'info', 'message' => 'Tour unpublished'];
    }

    public function feature($id)
    {
        $tour = Tour::find($id);
        $tour->featured = 1;
        $tour->save();
        return ['type' => 'success', 'message' => 'Tour set as featured.'];
    }

    public function removeFeature($id)
    {
        $tour = Tour::find($id);
        $tour->featured = 0;
        $tour->save();
        return ['type' => 'info', 'message' => 'Tour removed from featured'];
    }

    public function getPromoteds()
    {
        $tours = Tour::where('status', '=', 1)->get();
        $promoteds = Tour::where('promote', '=', 1)->get();
        return view('backend.tour.promote')
            ->withTours($tours)
            ->withPromoteds($promoteds);
    }

    public function promoteTour(Request $request)
    {
        Tour::whereIn('id', $request->promote)->update(['promote' => 1]);
        Tour::whereNotIn('id', $request->promote)->update(['promote' => 0]);

        return redirect()->route('tour.promote');
    }

    public function removePromote($id)
    {
        $tour = Tour::find($id);
        if ($tour) {
            $tour->promote = 0;
            $tour->save();    
            return response()->json(200);
        }
        else {
            return response()->json(['message' => 'Invalid request!'],400);
        }

    }
}
