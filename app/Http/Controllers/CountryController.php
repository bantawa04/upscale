<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;
use App\Media;
use App\Traits\ImageKitUtility;

class CountryController extends Controller
{
    use ImageKitUtility;
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
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'map' => 'required|mimes:png'
        ]);

        if (!empty($request->featured)) {
            $image = Media::findOrFail($request->featured);

            $request->merge([
                'thumb' => str_replace('azq00gyzbcp', 'azq00gyzbcp/tr:n-tFetThumb', $image->url), //400x300
                'path' => str_replace('azq00gyzbcp', 'azq00gyzbcp/tr:n-trFetLg', $image->url), //1024x512
            ]);
        }

        if (!empty($request->map)) {
            $response = $this->uploadToImageKit($request->file('map'), $request->name . '_map_.png', 'map', null, null);
            $request->merge([
                'mapURL' => $response->success->url,
                'fileID' => $response->success->fileId
            ]);
        }
        $country = new Country;
        $country->name = $request->name;
        $country->description = $request->description;
        $country->path = $request->path;
        $country->map = $request->mapURL;
        $country->thumb = $request->thumb;
        $country->fileID = $request->fileID;
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
            'description' => 'required',
            'map' => 'required|mimes:png'
        ]);
        if (!empty($request->featured)) {
            $image = Media::findOrFail($request->featured);
            $country->thumb = str_replace('azq00gyzbcp', 'azq00gyzbcp/tr:n-tFetThumb', $image->url); //400x300
            $country->thumb = str_replace('azq00gyzbcp', 'azq00gyzbcp/tr:n-trFetLg', $image->url); //1024x512

        }

        if (!empty($request->map)) {
            $response = $this->uploadToImageKit($request->file('map'), $request->name . '_map.png', 'map', null, null);
            $country->map = $response->success->url;
            $country->fileID = $response->success->fileId;
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
        try {
            $country = Country::findOrFail($id);
            $this->deleteImage($country->fileID);
            $country->delete();
            return response()->json($country);
        } catch (\Exception $e) {
            $msg = [
                'id' => $id,
                'code' => $e->getCode(),
                'errMsg' => $e->getCode(),
                'msg' => 'Item cannot be delted'
            ];
            return json_encode($msg);
        }
    }
}
