<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Serie;
use App\Http\Requests\SeriesFormRequest;

class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $series = Serie::query()->orderBy('title')->get();
        $message = $request->session()->get('message');
        return view('series/index', compact('series', 'message'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('series/create')->with('action','create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeriesFormRequest $request)
    {
        $serie = new Serie();
        $serie->title = $request->title;
        $serie->save();
        $request->session()->put('message',[
            'type' => 'success',
            'body' => 'Série '.$serie->title.' criada com sucesso!'
        ]);

        return Redirect::route('series.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function show(Serie $serie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $uuid)
    {
        $serie = Serie::find($uuid);
        $serie->delete();
        $request->session()->put('message',[
            'type' => 'danger',
            'body' => 'Série deletada com sucesso!'
        ]);

        return Redirect::route('series.index');
    }
}
