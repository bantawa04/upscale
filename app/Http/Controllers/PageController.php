<?php

namespace App\Http\Controllers;

use App\Page;
use App\Media;
use Illuminate\Http\Request;
use App\Traits\ImageKitUtility;
use App\Traits\ResponseMessage;
use App\Traits\SelectOption;

class PageController extends Controller
{
    use ImageKitUtility;
    use ResponseMessage;
    use SelectOption;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->pages = Page::orderBy('created_at','desc')->get();
        $this->images = Media::orderBy('created_at', 'desc')->get();
    }

    public function index()
    {
        return view('backend.page.index')->withPages($this->pages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.page.create')
            ->withImages($this->images)
            ->withPages($this->pages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
        $this->validate($request, [
            'title' => 'required|required',
            'position' => 'required|numeric',
            'content' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required'
        ]);

        $page = new Page;
        $page->title = $request->title;
        $page->content = $request->content;
        $page->main = $request->isParent;
        $page->parentpage = $request->parentPage;
        $page->position = $request->position;
        if (!$request->status) {
            $page->status = 0;
        }
        else{
            $page->status = $request->status;
        }

        if (!empty($request->featured)) {
            $media = Media::findOrFail($request->featured);
            // $path = UploadManager::fromMedia($image->path, 1136, 640,"test");            
            $page->banner = str_replace(env('IMAGE_KIT_URL'), env('IMAGE_KIT_URL').'/tr:n-pBanner', $media->url);
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
            ->withImages($this->images)
            ->withPages($this->pages);
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
        // dd($request->all());
        $this->validate($request, [
            'title' => 'required|required',
            'position' => 'required|numeric',
            'content' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required'
        ]);

        $page->title = $request->title;
        $page->content = $request->content;
        $page->main = $request->isParent;
        $page->parentpage = $request->parentPage;
        $page->position = $request->position;

        if (!empty($request->featured)) {
            $media = Media::findOrFail($request->featured);
            // $path = UploadManager::fromMedia($image->path, 1136, 640,"test");
            $page->banner = str_replace(env('IMAGE_KIT_URL'), env('IMAGE_KIT_URL').'/tr:n-pBanner', $media->url);
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
        try {
            $page = Page::find($id);
            $page->delete();
            $msg = $this->onSuccess($id);
            return response()->json($msg);
        } catch (\Exception $e) {
            $msg = $this->onError($e);
            return response()->json($msg);
        }
    }

    public function publish($id)
    {
        $page = Page::find($id);
        $page->status = 1;
        $page->save();
        return ['type' => 'success', 'message' => 'Page published'];
    }

    public function unpublish($id)
    {
        $page = Page::find($id);
        $page->status = 0;
        $page->save();
        return ['type' => 'info', 'message' => 'Page unpublished'];
    }
}
