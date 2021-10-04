<?php

namespace App\Http\Controllers;

use App\Recommended;
use App\Traits\ImageKitUtility;
use App\Traits\ResponseMessage;
use Illuminate\Http\Request;
use Image;
use ImageOptimizer;

class RecommendedController extends Controller
{
    use ResponseMessage;
    use ImageKitUtility;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $path = "img/";
    public function index()
    {
        $recommendeds = Recommended::all();
        return view('backend.recommended.index')
            ->withItems($recommendeds);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.recommended.create');
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
            'photo' => 'required|mimes:png|max:10000'
        ]);

        $file = $request->file('photo');
        $filename = time() . '_recom' . $file->getClientOriginalExtension();
        $location = $this->path . $filename;
        Image::make($file)->resize(267, 150)->save($location);
        ImageOptimizer::optimize($location);
        return Recommended::create([
            'name' => "Name not set",
            'logo' => $location
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recommended  $recommended
     * @return \Illuminate\Http\Response
     */
    public function show(Recommended $recommended)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recommended  $recommended
     * @return \Illuminate\Http\Response
     */
    public function edit(Recommended $recommended)
    {
        return view('backend.recommended.edit')
            ->withRecommended($recommended);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recommended  $recommended
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recommended $recommended)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $recommended->update($request->all());

        return redirect()->route('recommended.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recommended  $recommended
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recommended $recommended)
    {
        try {            
            $this->deleteImage($recommended->fileID);
            $recommended->delete();
            $msg = $this->onSuccess($recommended->id);
            return response()->json($msg);
        } catch (\Exception $e) {
            $msg = $this->onError($e);
            return response()->json($msg);
        }
    }
}
