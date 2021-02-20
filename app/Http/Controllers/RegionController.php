<?php

namespace App\Http\Controllers;

use App\Region;
use Illuminate\Http\Request;
use App\UploadManager;
use App\Media;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $path = "img/";
    private $thumb = "img/";

    function __construct()
    {
        $this->medias = Media::all();
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

        if(!empty($request->featured)){
            $image = Media::findOrFail($request->featured);                
            $path = UploadManager::fromMedia($image->path, 1024, 512, "reg_");
            $thumb = UploadManager::fromMedia($image->path, 400, 300, "reg_thumb_");
            $request->merge([
                'path' => $path,
                'thumb' => $thumb
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
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required'
        ]);
        if(!empty($request->featured)){
            $oldImage= $region->image;
            $oldThumb= $region->thumb;
            $image = Media::findOrFail($request->featured);                
            $path = UploadManager::fromMedia($image->path, 1024, 512, "con_");
            $thumb = UploadManager::fromMedia($image->path, 400, 300, "con_thumb_");
            $request->merge([
                'path' => $path,
                'thumb' => $thumb
                ]);
            @unlink($oldImage);
            @unlink($oldThumb);
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
        $region = Region::findOrFail($id);
        @unlink($region->image);
        @unlink($region->thumb);
        $region->delete();
        return response()->json($region);
    }
}
