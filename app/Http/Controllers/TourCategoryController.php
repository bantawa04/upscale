<?php

namespace App\Http\Controllers;

use App\TourCategory;
use Illuminate\Http\Request;
use App\UploadManager;
use App\Media;

class TourCategoryController extends Controller
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

        if(!empty($request->featured)){
            $image = Media::findOrFail($request->featured);                
            $path = UploadManager::fromMedia($image->path, 1024, 512, "cat_");
            $thumb = UploadManager::fromMedia($image->path, 500, 500, "cat_thumb_");
            $thumb1 = UploadManager::fromMedia($image->path, 344, 534, "cat_thumb1_");
            $request->merge([
                'path' => $path,
                'thumb' => $thumb,
                'thumb1' => $thumb1
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
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required'
        ]);
        
        $category = TourCategory::findOrFail($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        if(!empty($request->featured)){
            $oldImage= $category->path;
            $oldThumb= $category->thumb;
            $oldThumb1= $category->thumb1;
            $image = Media::findOrFail($request->featured);                
            $path = UploadManager::fromMedia($image->path, 1024, 512, "cat_");
            $thumb = UploadManager::fromMedia($image->path, 500, 500, "cat_thumb_");
            $thumb1 = UploadManager::fromMedia($image->path, 344, 534, "cat_thumb1_");
            $category->path = $path;
            $category->thumb = $thumb;
            $category->thumb1 = $thumb1;
            
            @unlink($oldImage);
            @unlink($oldThumb);
            @unlink($oldThumb1);
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
        $category = TourCategory::findOrFail($id);
        @unlink($category->image);
        @unlink($category->thumb);
        $category->delete();
        return response()->json($category);
    }
}
