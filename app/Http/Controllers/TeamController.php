<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;
use App\Type;
use Image;
use App\Traits\SelectOption;

class TeamController extends Controller
{
    use SelectOption;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     private $path = "img/";

     public function __construct()
     {
        $this->types = $this->selectOption(Type::all());
     }

    public function index()
    {
        $teams = Team::all();

        return view('backend.team.index')
        ->withTeams($teams);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.team.create')        
        ->withTypes($this->types);
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
            'name' => 'required',
            'image' => 'required',
            'position' => 'required'
        ]);
        // dd($request->all());
        $team = new Team;
        $team->name = $request->name;
        $team->position = $request->position;
        $team->type_id = $request->type;
        $team->description = $request->description;

        if (!empty($request->image)) {
            $file = $request->file('image');
            $filename = time() . '-' . $file->getClientOriginalName();
            $location = $this->path . $filename;
            Image::make($file)->resize(280,350)->save($location);
            $team->image = $location;
        } 

        $team->save();
        return redirect()->route('team.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        return view('backend.team.show')
        ->withTeam($team);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        return view('backend.team.edit')
        ->withTeam($team)
        ->withTypes($this->types);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'sometimes',
            'position' => 'required'
        ]);
        $team->name = $request->name;
        $team->position = $request->position;
        $team->type_id = $request->type_id;
        $team->description = $request->description;

        if (!empty($request->image)) {
            $oldimage = $team->image;

            $file = $request->file('image');
            $filename = time() . '-' . $file->getClientOriginalName();
            $location = $this->path . $filename;
            Image::make($file)->resize(280,350)->save($location);
            $team->image = $location;

            @unlink($oldimage);
        }    

        $team->save();

        return redirect()->route('team.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team = Team::find($id);
        @unlink($team->image);
        $team->delete();
        return redirect()->route('team.index');
    }
}
