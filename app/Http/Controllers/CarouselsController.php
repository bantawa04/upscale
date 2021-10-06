<?php

namespace App\Http\Controllers;

use App\Carousel;
use Illuminate\Http\Request;
use App\Traits\ImageKitUtility;
use App\Traits\LocalUpload;
use App\Traits\ResponseMessage;

class CarouselsController extends Controller
{
    use ImageKitUtility;
    use LocalUpload;
    use ResponseMessage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $path = "img/";

    public function index()
    {
        $carousels = Carousel::all();
        return view('backend.carousel.index')->withCarousels($carousels);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.carousel.create');
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

        //generate thumbnail
        $thumbnail = $this->uploadThumbnail($request->photo, $this->path, 'car_thumb_', 391, 220);
        //file to upload
        $path = $this->uploadThumbnail($request->photo, $this->path, 'car_thumb_', 1920, 1080);
        //response after upload
        $response = $this->uploadToImageKit($path, 'car_.jpg', 'carousel', null, null, true);
        //extract url
        $url = str_replace(env('IMAGE_KIT_URL'), env('IMAGE_KIT_URL').'/tr:n-carousel', $response->success->url);
        @unlink($path);
        return Carousel::create([
            'thumb' => $thumbnail,
            'url'   => $url,
            'fileID'   => $response->success->fileId,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Carouse  $carouse
     * @return \Illuminate\Http\Response
     */
    public function show(Carousel $carousel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Carouse  $carouse
     * @return \Illuminate\Http\Response
     */
    public function edit(Carousel $carousel)
    {
        return view('backend.carousel.edit')->withCarousel($carousel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Carouse  $carouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carousel $carousel)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $carousel->name = $request->name;
        $carousel->heading = $request->heading;
        $carousel->save();

        return redirect()->route('carousel.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Carouse  $carouse
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $carousel = Carousel::findorFail($id);
            @unlink($carousel->thumb);
            $this->deleteImage($carousel->fileID);
            $carousel->delete();
            $msg = $this->onSuccess($id);
            return response()->json($msg);
        } catch (\Exception $e) {
            $msg = $this->onError($e);
            return response()->json($msg);
        }

    }
}
