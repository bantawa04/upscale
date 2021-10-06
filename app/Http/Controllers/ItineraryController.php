<?php

namespace App\Http\Controllers;

use App\Itinerary;
use App\Tour;
use App\Traits\ResponseMessage;
use Illuminate\Http\Request;

class ItineraryController extends Controller
{
    use ResponseMessage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $tour = Tour::find($id);
        $itineraries = Itinerary::where('tour_id', '=', $tour->id)->orderByRaw('CONVERT(day, UNSIGNED) ASC')->get();
        return view('backend.itinerary.index')
            ->withItineraries($itineraries)
            ->withTour($tour);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'day' => 'required|numeric',
            'title' => 'required',
            'description' => 'required'
        ]);

        $itinerary = new Itinerary;
        $itinerary->tour_id = $request->tour_id;
        $itinerary->day = $request->day;
        $itinerary->title = $request->title;
        $itinerary->description = $request->description;
        $itinerary->save();

        return redirect()
            ->route('itinerary.index', $request->tour_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Itinerary  $itinerary
     * @return \Illuminate\Http\Response
     */
    public function show(Itinerary $itinerary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Itinerary  $itinerary
     * @return \Illuminate\Http\Response
     */
    public function edit($tourID, $id)
    {
        $tour = Tour::find($tourID);
        $itinerary = Itinerary::find($id);
        return view('backend.itinerary.edit')
            ->withItinerary($itinerary)
            ->withTour($tour);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Itinerary  $itinerary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Itinerary $itinerary)
    {
        $this->validate($request, [
            'day' => 'required|numeric',
            'title' => 'required',
            'description' => 'required'
        ]);
        $itinerary->tour_id = $request->tour_id;
        $itinerary->day = $request->day;
        $itinerary->title = $request->title;
        $itinerary->description = $request->description;
        $itinerary->save();

        return redirect()
            ->route('itinerary.index', $request->tour_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Itinerary  $itinerary
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $itinerary = Itinerary::find($id);
            $itinerary->delete();
            $msg = $this->onSuccess($id);
            return response()->json($msg);
        } catch (\Exception $e) {
            $msg = $this->onError($e);
            return response()->json($msg);
        }
    }
}
