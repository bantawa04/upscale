<?php

namespace App\Http\Controllers;

use App\Media;
use Illuminate\Http\Request;
use App\UploadManager;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $path = "img/";
    private $thumb = "img/";
    public function index()
    {
        $medias = Media::latest()->paginate(18);
        return view('backend.media.index')
        ->withMedias($medias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.media.create');
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
            'photo' => 'required|mimes:jpg,jpeg,JPG,JPGE|max:10000'
        ]);
        $photo = UploadManager::uploadImageFull($request->photo, $this->path, $this->thumb);
        return Media::create([
            'thumb' => $photo[1],
            'path' => $photo[0]            
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $media = Media::findOrFail($id);
        return view('backend.media.edit')->withMedia($media);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $media = Media::findOrFail($id);
        $media->update($request->all());

        return redirect()->route('media.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        @unlink($media->path); 
        @unlink($media->thumb); 
        $media->delete();
        return response()->json($media);
    }
}
