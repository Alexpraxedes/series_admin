<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Models\{ Season, Serie, Episode };
use App\Services\{ Series, Episodes };

class Seasons
{
    public function create($seasons_data, $episodes_data, $serie) : void
    {
        $episode = new Episodes(); 
        for ($s = 1; $s <= $seasons_data; $s++){
            $season = $serie->seasons()->create( ['data' => $s] );

            $episode->create( $season, $episodes_data );
        }
    }

    public function update( $request, Serie $serie_up ) : void
    {
        $episodes = new Episodes();
        $seasons = Serie::find($serie_up->uuid)->seasons;
        foreach($seasons as $season_up){
            $index = 'season-'.$season_up->id;
            $season_up->data = $request[$index];
            $episodes->update( $season_up, $request );

            $season_up->save();
        }
    }

    public function delete( Serie $serie ) : void
    {   
        $serie->seasons()->each(function ($season){
            $episode = new Episodes();
            $episode->delete( $season );
        });

        $serie->seasons()->delete();
    }
};