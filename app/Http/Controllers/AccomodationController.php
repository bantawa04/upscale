<?php

namespace App\Http\Controllers;

use App\Accomodation;
use Illuminate\Http\Request;

class AccomodationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accomodations = Accomodation::all();
        return view('backend.accomodation.index')->withAccomodations($accomodations);
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

        $accomodation = new Accomodation;
        $accomodation->name = $request->name;
        $accomodation->save();

        return redirect()->route('accomodation.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Accomodation  $accomodation
     * @return \Illuminate\Http\Response
     */
    public function show(Accomodation $accomodation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Accomodation  $accomodation
     * @return \Illuminate\Http\Response
     */
    public function edit(Accomodation $accomodation)
    {
        return view('backend.accomodation.edit')->withAccomodation($accomodation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Accomodation  $accomodation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Accomodation $accomodation)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $accomodation->name = $request->name;
        $accomodation->save();

        return redirect()->route('accomodation.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Accomodation  $accomodation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $accomodation = Accomodation::findOrFail($id);
        $accomodation->delete();
        return response()->json($accomodation);
    }
}
