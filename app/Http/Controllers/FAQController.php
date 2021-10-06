<?php

namespace App\Http\Controllers;

use App\FAQ;
use App\Tour;
use App\Traits\ResponseMessage;
use App\Traits\SelectOption;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    use ResponseMessage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use SelectOption;
    public function __construct()
    {
        $this->tours = $this->selectOption(Tour::all());
    }
    public function index()
    {
        $faqs = FAQ::all();

        return view('backend.faq.index')
            ->withFaqs($faqs)
            ->withTours($this->tours);
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
            'question' => 'required',
            'answer' => 'required'
        ]);
        $faq = new FAQ;
        $faq->tour_id = $request->tour_id;
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();
        return redirect()->route('faq.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function show(FAQ $fAQ)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function edit(FAQ $faq)
    {
        return view('backend.faq.edit')
            ->withFaq($faq)
            ->withTours($this->tours);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FAQ $faq)
    {
        $this->validate($request, [
            'question' => 'required',
            'answer' => 'required'
        ]);
        $faq->update($request->all());
        return redirect()->route('faq.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $faq = FAQ::find($id);
            $faq->delete();
            $msg = $this->onSuccess($id);
            return response()->json($msg);
        } catch (\Exception $e) {
            $msg = $this->onError($e);
            return response()->json($msg);
        }
    }
}
