<?php

namespace App\Http\Controllers;

use App\BlogCategory;
use App\Media;
use App\Post;
use App\Tag;
use DB;
use App\Traits\SelectOption;
use App\Traits\ResponseMessage;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use SelectOption;
    use ResponseMessage;
    public function __construct()
    {
        $this->tags = Tag::all();
        $this->medias = Media::all();
        $this->categories = $this->selectOption(BlogCategory::all());
    }
    public function index()
    {
        $posts = Post::all();
        return view('backend.post.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.post.create')
            ->withTags($this->tags)
            ->withCategories($this->categories)
            ->withImages($this->medias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $this->validate($request, [
                'title' => 'required',
                'featured' => 'required',
                'title' => 'required',
                'meta_title' => 'required',
                'meta_description' => 'required'
            ]);
            $post = new Post;
            $post->title = $request->title;
            $post->category_id = $request->category_id;
            $post->status = $request->status;
            $post->content = $request->content;
            $post->title = $request->titleTag;
            $post->meta_title = $request->meta_title;
            $post->meta_description = $request->meta_description;

            if (!empty($request->featured)) {
                $media = Media::findOrFail($request->featured);
                $request->merge([
                    'path' => str_replace(env('IMAGE_KIT_URL'), env('IMAGE_KIT_URL').'/tr:n-blogImg', $media->url), //1200x394
                    'thumb' => str_replace(env('IMAGE_KIT_URL'), env('IMAGE_KIT_URL').'/tr:n-blogThumb', $media->url) //780x440
                ]);
                $post->path = $request->path;
                $post->thumb = $request->thumb;
            }

            $post->save();
            // dd($request->all());
            $post->tags()->sync($request->tags, false);
            
            DB::commit();
            return redirect()->route('post.show', $post->id);
        } catch (\Exception $th) {
            DB::rollback();
            return $th->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('backend.post.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('backend.post.edit')
            ->withPost($post)
            ->withTags($this->tags)
            ->withCategories($this->categories)
            ->withImages($this->medias);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // dd($request->all());
        $this->validate($request, [
            'title' => 'required',
            'title' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required'
        ]);

        $post->title = $request->title;
        $post->category_id = $request->category_id;
        $post->status = $request->status;
        $post->content = $request->content;
        $post->title_tag = $request->titleTag;
        $post->meta_title = $request->meta_title;
        $post->meta_description = $request->meta_description;

        if (!empty($request->featured)) {
            $media = Media::findOrFail($request->featured);

            $post->path = str_replace(env('IMAGE_KIT_URL'), env('IMAGE_KIT_URL').'/tr:n-blogImg', $media->url); //1200x394
            $post->thumb = str_replace(env('IMAGE_KIT_URL'), env('IMAGE_KIT_URL').'/tr:n-blogThumb', $media->url); //780x440
        }
        $post->save();
        $post->tags()->sync($request->tags);
        return redirect()->route('post.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $post = Post::find($id);
            $post->tags()->detach();
            $post->delete();
            $msg = $this->onSuccess($id);
            return response()->json($msg);
        } catch (\Exception $e) {
            $msg = $this->onError($e);
            return response()->json($msg);
        }
    }


    public function publish($id)
    {
        $post = Post::find($id);
        $post->status = 1;
        $post->save();
        return ['type' => 'success', 'message' => 'Post published'];
    }

    public function unpublish($id)
    {
        $post = Post::find($id);
        $post->status = 0;
        $post->save();
        return ['type' => 'info', 'message' => 'Post unpublished'];
    }

    public function feature($id)
    {
        $post = Post::find($id);
        $post->featured = 1;
        $post->save();
        DB::table('posts')
            ->where('id', '<>', $id)
            ->update(['featured' => 1]);
        return ['type' => 'success', 'message' => 'Post set as featured.'];
    }

    public function removeFeature($id)
    {
        $post = Post::find($id);
        $post->featured = 0;
        $post->save();
        return ['type' => 'info', 'message' => 'Post removed from featured'];
    }
}
