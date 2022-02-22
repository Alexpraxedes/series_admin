<?php

namespace App\Collections;
use Illuminate\Database\Eloquent\Collection;
use App\Models\{ Season, Episode };

class EpisodeCollection extends Collection
{
    // Return for client the episodes all
    public function getAllEpisodes()
    {
        foreach($this as $season ){
            return $season->episodes;
        };
    }

    // Return for client the watched episodes
    public function getWatchedEpisodes() : Collection
    {
        foreach($this as $season ){
            return $season->episodes->filter( function (Episode $episode){
                return $episode->watched;
            });
        }
    }
}