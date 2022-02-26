<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Serie;
use App\Services\Series;

class SeriesCreateTest extends TestCase
{
    /** @test */
    public function series_create()
    {
        $serie = new Series;
        $newSerie = new Serie();
        $newSerie->title = 'Test name';
        $newSerie->image = null;
        $newSerie->seasons_data = 1;
        $newSerie->episodes_data = 1;
        
        $newSerie = $serie->create($newSerie);
        
        $this->assertInstanceOf( Serie::class, $newSerie );
        $this->assertDataBaseHas( 'series', ['title' => 'Test name'] );
        $this->assertDataBaseHas( 'seasons', ['serie_uuid' => $newSerie->uuid, 'id' => 1] );
        $this->assertDataBaseHas( 'episodes', ['id' => 1] );
    }
}
