<?php

namespace App\Http\Controllers;

use App\Carousel;
use Illuminate\Http\Request;
use App\Traits\ImageKitUtility;
use App\Traits\LocalUpload;

class CarouselsController extends Controller
{
    use ImageKitUtility;
    use LocalUpload;
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

        $thumbnail = $this->uploadThumbnail($request->photo, $this->path, 'car_thumb_', 391, 220);
        $response = $this->uploadToImageKit($request->file('photo'), 'car_.jpg', 'carousel', 2080, 1170);
        return Carousel::create([
            'thumb' => $thumbnail,
            'url'   => $response->success->url,
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
        $carousel = Carousel::findorFail($id);
        @unlink($carousel->thumb);
        $this->deleteImage($carousel->fileID);
        $carousel->delete();
        return response()->json($carousel);
    }
}
