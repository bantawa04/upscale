<?php

namespace App\Http\Controllers;

use App\Media;
use Illuminate\Http\Request;
use App\Traits\LocalUpload;
use App\Traits\ImageKitUtility;
use App\Traits\ResponseMessage;

class MediaController extends Controller
{
    use LocalUpload;
    use ImageKitUtility;
    use ResponseMessage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $path = "img/";
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
        try {
            $this->validate($request, [
                'photo' => 'required|mimes:jpg,jpeg,JPG,JPGE|max:10000'
            ]);

            // $response = $this->uploadToImageKit($request->file('photo'), 'med_.jpg', 'media', 2080, 1170);
            $response = $this->uploadToImageKit($request->file('photo'), 'med_.jpg', 'media', null, null, false);
            $thumb = $this->uploadThumbnail($request->file('photo'), $this->path, 'med_thumb_', 286, 180);
            // return json_encode($response);
            return Media::create([
                'thumb' => $thumb,
                'url' => $response->success->url,
                'fileID' => $response->success->fileId,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
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
        try {
            $media = Media::findOrFail($id);
            @unlink($media->thumb);
            $this->deleteImage($media->fileID);
            $media->delete();
            $msg = $this->onSuccess($id);
            return response()->json($msg);
        } catch (\Exception $e) {
            $msg = $this->onError($e);
            return response()->json($msg);
        }
    }
}
