<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;
use Image;
use App\Tour;

class ReviewController extends Controller
{
    private $path = "img/";
    public function __construct()
    {
        $this->tours = Tour::all();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::all();
        return view('backend.reviews.index')->withReviews($reviews);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.reviews.create')->withTours($this->tours);
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
        $this->validate($request, [
            'name'     =>  'required',
            'email'     => 'required',
            'country'   => 'required',
            'title'   => 'required|min:10',
            'comment'   => 'required|min:10'
        ]);
        // dd($request->productrating);
        $review = new Review;
        $review->name = $request->name;
        $review->email = $request->email;
        $review->country = $request->country;
        $review->title = $request->title;
        $review->comment = $request->comment;
        $review->rating = $request->rating;

        if($request->hasFile('photo')){
            $image = $request->file('photo');
            $filename = 'rev_'.time().'.'.$image->getClientOriginalExtension();
            $location = $this->path.$filename;
            Image::make($image)->resize(200, 200)->save($location);
            $review->thumbnail = $location;
        }
        else{
            $url="https://www.gravatar.com/avatar/";
            $review->thumbnail = $url.md5(strtolower(trim($review->email)))."?s=64&d=monsterid";
        }
        $review->tour_id = $request->tour_id;
        $review->status = false;
        $review->save();

        // return back();
        return 'Done';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        @unlink($review->thumnnail);
        $review->delete();        
        return redirect()->route('review.index');
    }

    public function approve($slug, $id)
    {
        $tour = Tour::where('slug', '=', $slug)
            ->first();
        $review = Review::find($id);
        $review->status = 1;
        $review->save();
        $tour->recalculateRating($review->rating);

        return redirect()
            ->route('review.index');
    }

}
