<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;
use App\UploadManager;
use App\Media;
use Image;

class CountryController extends Controller
{
    private $path = "img/";
    private $thumb = "img/";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->medias = Media::all();
    }
    public function index()
    {
        $countries = Country::all();
        return view('backend.country.index')
            ->withImages($this->medias)
            ->withCountries($countries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        if (!empty($request->featured)) {
            $image = Media::findOrFail($request->featured);
            $path = UploadManager::fromMedia($image->path, 1024, 512, "con_");
            $thumb = UploadManager::fromMedia($image->path, 400, 300, "con_thumb_");
            $request->merge([
                'path' => $path,
                'thumb' => $thumb
            ]);
        }

        if (!empty($request->map)) {

            $file = $request->file('map');
            $filename = time() . '-' . $file->getClientOriginalName();
            $location = $this->path . $filename;
            Image::make($file)->save($location);
            $request->merge([
                'location' => $location,
            ]);
        }

        $country = new Country;
        $country->name = $request->name;
        $country->description = $request->description;
        $country->path = $request->path;
        $country->map = $request->location;
        $country->thumb = $request->thumb;
        $country->meta_title = $request->meta_title;
        $country->meta_description = $request->meta_description;
        $country->save();

        return redirect()->route('country.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        return view('backend.country.edit')
            ->withImages($this->medias)
            ->withCountry($country);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);
        if (!empty($request->featured)) {
            $oldImage = $country->image;
            $oldThumb = $country->thumb;
            $image = Media::findOrFail($request->featured);
            $path = UploadManager::fromMedia($image->path, 1024, 512, "con_");
            $thumb = UploadManager::fromMedia($image->path, 400, 300, "con_thumb_");
            $country->path = $path;        
            $country->thumb = $thumb;

            @unlink($oldImage);
            @unlink($oldThumb);
            
        }

        if (!empty($request->map)) {
            $oldMap = $country->map;
            $file = $request->file('map');
            $filename = time() . '-' . $file->getClientOriginalName();
            $location = $this->path . $filename;
            Image::make($file)->save($location);
            @unlink($oldMap);
            $country->map = $location;
        }
        $country->name = $request->name;
        $country->description = $request->description;
        $country->meta_title = $request->meta_title;
        $country->meta_description = $request->meta_description;
        $country->save();
        return redirect()->route('country.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        @unlink($country->image);
        @unlink($country->thumb);
        @unlink($country->map);
        $country->delete();
        return response()->json($country);
    }
}
