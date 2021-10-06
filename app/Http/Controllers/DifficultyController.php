<?php

namespace App\Http\Controllers;

use App\Difficulty;
use Illuminate\Http\Request;

class DifficultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $difficulties = Difficulty::all();
        return view('backend.difficulty.index')->withDifficulties($difficulties);
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

        $difficulty = new Difficulty;
        $difficulty->name = $request->name;
        $difficulty->save();

        return redirect()->route('difficulty.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Difficulty  $difficulty
     * @return \Illuminate\Http\Response
     */
    public function show(Difficulty $difficulty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Difficulty  $difficulty
     * @return \Illuminate\Http\Response
     */
    public function edit(Difficulty $difficulty)
    {
        return view('backend.difficulty.edit')->withDifficulty($difficulty);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Difficulty  $difficulty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Difficulty $difficulty)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $difficulty->name = $request->name;
        $difficulty->save();

        return redirect()->route('difficulty.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Difficulty  $difficulty
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $difficulty = Difficulty::findOrFail($id);
            $difficulty->delete();
            $msg = $this->onSuccess($id);
            return response()->json($msg);
        } catch (\Exception $e) {
            $msg = $this->onError($e);
            return response()->json($msg);
        }
    }
}
