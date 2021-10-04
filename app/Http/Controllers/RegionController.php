<?php

namespace App\Http\Controllers;

use App\Region;
use Illuminate\Http\Request;
use App\Traits\ImageKitUtility;
use App\Media;
use App\Traits\ResponseMessage;

class RegionController extends Controller
{
    use ImageKitUtility;
    use ResponseMessage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $path = "img/";
    private $thumb = "img/";

    function __construct()
    {
        $this->medias = Media::orderBy('created_at', 'desc')->get();
    }

    public function index()
    {
        $region = Region::all();
        return view('backend.region.index')
            ->withImages($this->medias)
            ->withRegions($region);
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
            $request->merge([
                'path' => str_replace(env('IMAGE_KIT_URL'), env('IMAGE_KIT_URL').'/tr:n-trFetLg', $image->url), //1024x512
                'thumb' => str_replace(env('IMAGE_KIT_URL'), env('IMAGE_KIT_URL').'/tr:n-tFetThumb', $image->url) //400x300
            ]);
        }

        $region = new Region;
        $region->name = $request->name;
        $region->description = $request->description;
        $region->path = $request->path;
        $region->thumb = $request->thumb;
        $region->meta_title = $request->meta_title;
        $region->meta_description = $request->meta_description;
        $region->save();

        return redirect()->route('region.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        return view('backend.region.edit')
            ->withImages($this->medias)
            ->withRegion($region);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);
        if (!empty($request->featured)) {
            $image = Media::findOrFail($request->featured);
            $request->merge([
                'path' => str_replace(env('IMAGE_KIT_URL'), env('IMAGE_KIT_URL').'/tr:n-trFetLg', $image->url), //1024x512
                'thumb' => str_replace(env('IMAGE_KIT_URL'), env('IMAGE_KIT_URL').'/tr:n-tFetThumb', $image->url) //400x300
            ]);
        }
        $region->update($request->all());
        return redirect()->route('region.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $region = Region::findOrFail($id);
            $region->delete();
            $msg = $this->onSuccess($id);
            return response()->json($msg);
        } catch (\Exception $e) {
            $msg = $this->onError($e);
            return response()->json($msg);
        }
    }
}
