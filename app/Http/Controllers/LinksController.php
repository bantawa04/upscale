<?php

namespace App\Http\Controllers;

use App\Link;
use DB;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $links = Link::all();

        return view('backend.link.index')
        ->withLinks($links);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.link.create')
        ->withOptions($this->allOptions());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'meta_title' => 'required',
            'meta_description' => 'required',
            'title' => 'required'
        ]);

        $link = new Link;
        $link->para_1 = $request->para1;
        $link->para_2 = $request->para2;
        $link->title = $request->title;
        // $link->description = $request->description;
        $link->meta_title = $request->meta_title;
        $link->meta_description = $request->meta_description;
        $link->save();

        return redirect()->route('links.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Links  $links
     * @return \Illuminate\Http\Response
     */
    public function show(Link $links)
    {
        return view('backend.link.show')->withLink($links);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Links  $links
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $link = Link::find($id);
        return view('backend.link.edit')
        ->withLink($link)
        ->withOptions($this->allOptions());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Links  $links
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'meta_title' => 'required',
            'meta_description' => 'required',
            'title' => 'required'
        ]);
        $link = Link::find($id);
        $link->para_1 = $request->para1;
        $link->para_2 = $request->para2;
        $link->title = $request->title;
        // $link->description = $request->description;
        $link->meta_title = $request->meta_title;
        $link->meta_description = $request->meta_description;
        $link->save();

        return redirect()->route('links.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Links  $links
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $link = Link::findOrFail($id);
        $link->delete();
        return response()->json($link);
    }

    public function allOptions()
    {
        $opt1 = DB::table('countries')
        ->select("countries.name","countries.slug");

        $opt2 = DB::table('tourcategories')
        ->select("tourcategories.name", "tourcategories.slug");

        $opt3 = DB::table('regions')
        ->select("regions.name","regions.slug")
        ->union($opt1)
        ->union($opt2)
        ->get();

        return $opt3;
    }

}
