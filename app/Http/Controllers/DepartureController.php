<?php

namespace App\Http\Controllers;

use App\Departure;
use App\Tour;
use DB;
use Illuminate\Http\Request;

class DepartureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->tours = Tour::all();
    }

    public function index()
    {
        $tours = Tour::whereHas('departure')->get();
        return view('backend.departure.index')->withTours($tours);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.departure.create')->withTours($this->tours);
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
            'gap' =>'required|numeric',
            'start' =>'required',
            'end' =>'required'
        ]);
        if (strtotime($request->start) < strtotime($request->end)) {
            foreach ($request->tour_id as $id) {
                $start = $request->start;
                $end = $request->end;
                $tour = Tour::find($id);
                date_default_timezone_set('Asia/Kathmandu');
                while (strtotime($start) <= strtotime($end)) {
                    $departure = new Departure;
                    $departure->tour_id = $tour->id;
                    $departure->start = $start;
                    $departure->end = date("Y-m-d", strtotime("+" . $tour->days . " days", strtotime($start)));
                    $departure->price = $tour->price;
                    $departure->save();
                    $start = date("Y-m-d", strtotime("+" . $request->gap . " days", strtotime($start)));
                }
            }
            return redirect()->route('departure.index');
        }
        else{
            // Session::flash('danger', 'End date must be greater than start date. ');
            return redirect()->route('departure.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Departure  $departure
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tour = Tour::find($id);
        return view('backend.departure.show')->withTour($tour);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Departure  $departure
     * @return \Illuminate\Http\Response
     */
    public function edit(Departure $departure)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Departure  $departure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departure $departure)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Departure  $departure
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $departure = Departure::find($id);
        $departure->delete();
        return redirect()->back();
    }

    public function deleteAll($id)
    {
        DB::table('departures')->where('tour_id', '=', $id)->delete();
        return redirect()->back();
    }
}
