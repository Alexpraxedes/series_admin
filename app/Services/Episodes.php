<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\{ Season, Episode };
use App\Services\{ Seasons };

class Episodes
{
    public function create( $season, $episodes_data ) : void
    {
        for ($e = 1; $e <= $episodes_data; $e++){
            $episode = $season->episodes()->create( ['data' => $e] );
        }
    }
    public function update( Season $season_up, $request ) : void
    {
        foreach($season_up->episodes as $episode_up){
            $index = 'episode-'.$episode_up->id;
            $watched = 'watched-'.$episode_up->id;
            
            if($request[$watched] == true )
                $episode_up->watched = true;
            else
            $episode_up->watched = false;

            $episode_up->data = $request[$index];

            $episode_up->save();
        }
    }

    public function delete( Season $season ) : void
    {   
        $season->episodes->each(function ($episode){
            $episode->delete();
        });
    }
};