<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Themes\CreateThemesRequest;
use App\Theme;

class ThemesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $themes = Theme::all();
        return view('admin.themes.index')->with('themes', $themes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.themes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateThemesRequest $request)
    {
        //dd($request->all());
        Theme::create([
            'name' => $request->name,
            'value' => $request->value,
        ]);

        session()->flash('success', 'Theme saved successfully!');

        return redirect(route('themes.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $theme = Theme::whereId($id)->firstOrFail();
        return view('admin.themes.create')->with('theme', $theme);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateThemesRequest $request, $id)
    {
        $theme = Theme::whereId($id)->firstOrFail();

        $theme->update([
            'name' => $request->name,
            'value' => $request->value 
        ]);

        session()->flash('success', 'Theme updated successfully!');

        return redirect(route('themes.index'));
    }

}
