<?php

namespace App\Http\Controllers;

use App\Newsletter;
use App\Traits\ResponseMessage;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    use ResponseMessage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Newsletter::all();
        return view('backend.newsletter.index')->withNewsletters($all);
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
        try {
            $request->validate([
                'fName' => 'required',
                'lName' => 'required',
                'email' => 'required | email', 
            ]);
            Newsletter::create([
                'fname' =>  strip_tags($request->fName),
                'lname' =>  strip_tags($request->lName),
                'email' =>  strip_tags($request->email)
            ]);

            return response()->json(['message' => 'success', 'statement' => 'You are subscribed to Upscale Adventures.', 'status' => 200],200);
        } catch (\Exception $e) {
            return response()->json(['statement'=> 'Sorry cannot subscribe to newsletter', 'status' => 500 ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function show(Newsletter $newsletter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function edit(Newsletter $newsletter)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Newsletter $newsletter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $newsletter = Newsletter::find($id);
            $newsletter->delete();
            $msg = $this->onSuccess($id);
            return response()->json($msg);
        } catch (\Exception $e) {
            $msg = $this->onError($e);
            return response()->json($msg);
        }
    }
}
