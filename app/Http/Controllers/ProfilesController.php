<?php

namespace App\Http\Controllers;

use App\User;
use Session;
use Image;
use Hash;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    private $path = "img/";

    /**
     * Display the specified resource.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('backend.user.index')->withUsers($users);
    }
    

    public function create()
    {
        return view('backend.user.create');
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users|string|max:255'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;    
        $user->password = Hash::make('password');
        $user->type = $request->type;
        $user->save();

        Session::flash('message','New user created');
        return redirect()->route('profile.index');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('backend.user.profile')->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('backend.user.edit')->withUser($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $user = User::find($id);
        $user->name = $request->name;

        if (!empty($request->avatar)) {
            $oldAvatar = $user->avatar;
            $file = $request->file('avatar');
            $filename = time() . '-'.str_slug($request->name,'-').'-' . $file->getClientOriginalName();
            $location = $this->path . $filename;
            Image::make($file)->resize(180,180)->save($location);
            $user->avatar = $location;
            @unlink($oldAvatar);
        }
        if(!empty($request->password && $request->conformpassword))
        {
            if($request->password === $request->conformpassword){            
                $user->password =  Hash::make($request->password);                
                Session::flash('message', 'Password changes successfully.');
            }
            else{
                Session::flash('message', 'Input passwords do not match.');
            }
        }
        $user->save();

        return redirect()->route('profile.show',$user->id);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        @unlink($user->avatar);
        $user->delete();
        return ['type'=>'info','message' => 'User deleted sucessfully. '];
    }
}
