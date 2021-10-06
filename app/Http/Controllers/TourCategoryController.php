<?php

namespace App\Http\Controllers;

use App\TourCategory;
use Illuminate\Http\Request;
use App\Traits\ImageKitUtility;
use App\Media;
use App\Traits\ResponseMessage;

class TourCategoryController extends Controller
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
        $this->medias = Media::all();
    }

    public function index()
    {
        $categories = TourCategory::all();
        return view('backend.tour-category.index')
            ->withImages($this->medias)
            ->withCategories($categories);
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
            $media = Media::findOrFail($request->featured);
            $request->merge([
                'path' => str_replace(env('IMAGE_KIT_URL'), env('IMAGE_KIT_URL').'/tr:n-tCatThumb1', $media->url),
                'thumb' => str_replace(env('IMAGE_KIT_URL'), env('IMAGE_KIT_URL').'/tr:n-tCatLg', $media->url),
                'thumb1' => str_replace(env('IMAGE_KIT_URL'), env('IMAGE_KIT_URL').'/tr:n-tCatThumb2', $media->url)
            ]);
        }

        $category = new TourCategory;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->path = $request->path;
        $category->thumb = $request->thumb;
        $category->thumb1 = $request->thumb1;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->save();

        return redirect()->route('tour-category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TourCategory  $tourCategory
     * @return \Illuminate\Http\Response
     */
    public function show(TourCategory $tourCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TourCategory  $tourCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(TourCategory $tourCategory)
    {
        return view('backend.tour-category.edit')
            ->withImages($this->medias)
            ->withCategory($tourCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TourCategory  $tourCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);

        $category = TourCategory::findOrFail($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        if (!empty($request->featured)) {
            $media = Media::findOrFail($request->featured);
            $category->path = str_replace(env('IMAGE_KIT_URL'), env('IMAGE_KIT_URL').'/tr:n-tCatThumb1', $media->url);
            $category->thumb = str_replace(env('IMAGE_KIT_URL'), env('IMAGE_KIT_URL').'/tr:n-tCatLg', $media->url);
            $category->thumb1 = str_replace(env('IMAGE_KIT_URL'), env('IMAGE_KIT_URL').'/tr:n-tCatThumb2', $media->url);
        }
        $category->save();
        return redirect()->route('tour-category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TourCategory  $tourCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $category = TourCategory::findOrFail($id);
            $category->delete();
            $msg = $this->onSuccess($id);
            return response()->json($msg);
        } catch (\Exception $e) {
            $msg = $this->onError($e);
            return response()->json($msg);
        }
    }
}
