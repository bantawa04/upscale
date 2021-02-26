<?php

namespace App\Http\Controllers;

use App\Carousel;
use Illuminate\Http\Request;
use App\UploadManager;
use App\Traits\UploadImageKit;

class CarouselsController extends Controller
{
    use UploadImageKit;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $path = "img/test/";
    private $thumb = "img/test/";

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
        $photo = UploadManager::uploadImage($request->photo, $this->path, $this->thumb,1024,768);
        Carousel::create([
            'thumb' => $photo[1],
            'path' => $photo[0]            
        ]);
        //thumb
        $thumbResponse = $this->uploadToImageKit(url()->full().$photo[1], $photo[3]);  
        //path
        $pathResponse = $this->uploadToImageKit(url()->full().$photo[0], $photo[2]);

        return $thumbResponse->success;
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
        @unlink($carousel->path); 
        @unlink($carousel->thumb); 
        $carousel->delete();
        return response()->json($carousel);
    }
}
