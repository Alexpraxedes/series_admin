<?php
namespace App\Services;

use Illuminate\Support\Facades\{ DB };
use App\Models\{ Serie, Season };
use App\Services\{ Seasons };

class Series
{
    public function create($request) : Serie
    {
        $season = new Seasons();
        $serie = '';
        DB::beginTransaction();
            // Up load image
            if( $request->hasFile('image') && $request->file('image')->isValid() ){
                $requestImage = $request->image;
                $extension = $requestImage->extension();
                $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . "." . $extension;
                $request->image->move(public_path('img/series'), $imageName);
                $serie->image = $imageName;
            }
            
            $serie = new Serie;
            $serie->title = $request->title;

            $serie->save();

            $season->create( $request->seasons_data, $request->episodes_data, $serie );
        DB::commit();
        
        return $serie;
    }

    public function update($request, $serie_up) : Serie
    {
        $seasons = new Seasons();
        DB::beginTransaction();
            $serie_up->title = $request['title'];
            $seasons->update( $request, $serie_up );

            $serie_up->save();
        DB::commit();
        
        return $serie_up;
    }

    public function delete($uuid) : string
    {   
        $serie_title = '';
        DB::beginTransaction();
            $serie = Serie::find($uuid);
            $seasons = new Seasons();
            $serie_title = $serie->title;

            $seasons->delete( $serie );
            $serie->delete(); 
        DB::commit();

        return $serie_title;
    }
};