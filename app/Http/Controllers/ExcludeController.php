<?php

namespace App\Http\Controllers;

use App\Exclude;
use App\Traits\ResponseMessage;
use Illuminate\Http\Request;

class ExcludeController extends Controller
{
    use ResponseMessage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $excludes = Exclude::all();
        return view('backend.exclude.index')->withExcludes($excludes);
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
        $exclude = new Exclude;
        $exclude->name = $request->name;
        $exclude->save();

        return redirect()->route('exclude.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exclude  $exclude
     * @return \Illuminate\Http\Response
     */
    public function show(Exclude $exclude)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exclude  $exclude
     * @return \Illuminate\Http\Response
     */
    public function edit(Exclude $exclude)
    {
        return view('backend.exclude.edit')->withExclude($exclude);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exclude  $exclude
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exclude $exclude)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $exclude->name = $request->name;
        $exclude->save();

        return redirect()->route('exclude.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exclude  $exclude
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $exclude = Exclude::findOrFail($id);
            // $exclude->tour()->detach();
            $exclude->delete();
            $msg = $this->onSuccess($id);
            return response()->json($msg);
        } catch (\Exception $e) {
            $msg = $this->onError($e);
            return response()->json($msg);
        }

    }
}
