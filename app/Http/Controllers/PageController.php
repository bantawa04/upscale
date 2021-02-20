<?php

namespace App\Http\Controllers;

use App\Page;
use App\Media;
use App\UploadManager;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->images = Media::all();
    }     

    public function index()
    {
        $pages = Page::all();
        return view('backend.page.index')->withPages($pages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.page.create')
        ->withImages($this->images);
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
        $this->validate( $request, [
            'title' => 'required|required',
            'position' => 'required|numeric',
            'content' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required'
        ]);

        $page = new Page;
        $page->title = $request->title;
        $page->content = $request->content;
        $page->main = $request->main;
        $page->position = $request->position;

        if (!empty($request->featured)) {
            $image = Media::findOrFail($request->featured);
            $path = UploadManager::fromMedia($image->path, 1136, 640,"test");
            $page->banner = $path;
        }   

        $page->meta_title = $request->meta_title;
        $page->meta_description = $request->meta_description;
        $page->save();    
        return redirect()->route('page.show', $page->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        return view('backend.page.show')
        ->withPage($page);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('backend.page.edit')
        ->withPage($page)
        ->withImages($this->images);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $this->validate( $request, [
            'title' => 'required|required',
            'position' => 'required|numeric',
            'content' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required'
        ]);

        $page->title = $request->title;
        $page->content = $request->content;
        $page->main = $request->main;
        $page->position = $request->position;

        if (!empty($request->featured)) {
            $oldBanner = $page->banner;
            $image = Media::findOrFail($request->featured);
            $path = UploadManager::fromMedia($image->path, 1136, 640,"test");
            $page->banner = $path;

            @unlink($oldBanner);
        }   

        $page->meta_title = $request->meta_title;
        $page->meta_description = $request->meta_description;
        $page->save();    
        return redirect()->route('page.show', $page->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);
        @unlink($page->banner);
        $page->delete();

        return ['type'=>'info','message' => 'Tour deleted sucessfully.'];
    }

    public function publish($id)
    {
        $page= Page::find($id);
        $page->status = 1;
        $page->save();
        return ['type'=>'success','message' => 'Page published'];
    }

    public function unpublish($id)
    {
        $page= Page::find($id);
        $page->status = 0;
        $page->save();
        return ['type'=>'info','message' => 'Page unpublished'];
    }     
}
