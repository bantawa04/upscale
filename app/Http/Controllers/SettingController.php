<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting= Setting::first();
        if ( $setting)
        {
            return view('backend.setting.edit')->withSetting($setting);
        }
        else{
            return view('backend.setting.create');
        }        
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
        $settings = Setting::all();
        if ($settings->count() < 1) {
                $setting = new Setting;
                $setting->company_name = $request->company_name;
                $setting->tagline = $request->tagline;
                $setting->address = $request->address;
                $setting->city = $request->city;
                $setting->phone = $request->phone;
                $setting->mobile = $request->mobile;
                $setting->website = $request->website;
                $setting->email = $request->email;
                $setting->facebook = $request->facebook;
                $setting->twitter = $request->twitter;
                $setting->instagram = $request->instagram;
                $setting->linkedin = $request->linkedin;
                $setting->pintrest = $request->pintrest;
                $setting->youtube = $request->youtube;
                $setting->meta_title = $request->meta_title;
                $setting->meta_description = $request->meta_description;
                $setting->save();
        }
        return redirect()->route('setting.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return view('backend.setting.edit')->withSetting($setting);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        $setting->update($request->all());
        return redirect()->route('setting.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
