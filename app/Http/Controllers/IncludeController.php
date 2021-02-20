<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Includes;

class IncludeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $includes = Includes::all();
        return view('backend.include.index')->withIncludes($includes);
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
        $include = new Includes;
        $include->name = $request->name;
        $include->save();

        return redirect()->route('include.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Includes $include)
    {
        return view('backend.include.edit')->withInclude($include);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Includes $include)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $include->name = $request->name;
        $include->save();

        return redirect()->route('include.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $include = Includes::findOrFail($id);
        // $include->tour()->detach();
        $include->delete();
        return response()->json($include);
    }
}
