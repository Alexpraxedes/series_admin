<?php

namespace App\Http\Controllers;
use App\Services\{ Seasons, Episodes, Series };
use App\Http\Requests\SeriesFormRequest;
use App\Models\{Serie, Season, Episode};
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

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
        return view('series/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeriesFormRequest $request, Series $serie)
    {   
        $serie_new = new Series;
        $serie_new = $serie->create($request);

        $seasons_quantity = $request->seasons_quantity;
        $episodes_quantity = $request->episodes_quantity;

        $request->session()->put('message',[
            'type' => 'success',
            'body' => 'A série '.$serie_new->title.' com suas temporadas('.$seasons_quantity.') e epsodios('.$episodes_quantity.') foi criada com sucesso!'
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
    public function edit($uuid, Request $request)
    {
        $serie = Serie::find($uuid);
        $message = $request->session()->get('message');
        return view('series/edit', compact('serie', 'message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function update(SeriesFormRequest $request, Series $serie, $uuid)
    {
        $serie_up = Serie::find($uuid);
        $serie = $serie->update($request, $serie_up);

        $request->session()->put('message',[
            'type' => 'success',
            'body' => 'A série '.$serie_up->title.' foi editada com sucesso com sucesso!'
        ]);
                
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $uuid, Series $serie)
    {
        $serie_deleted = $serie->delete($uuid);
        
        $request->session()->put('message',[
            'type' => 'danger',
            'body' => 'A série '.$serie_deleted.' foi deletada com sucesso!'
        ]);

        return Redirect::route('series.index');
    }
}
