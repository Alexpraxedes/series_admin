<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccessTest extends TestCase
{
    // check access in plataform
    /** @test */
    public function only_logged_access()
    {
        $response = $this->get('/')->assertRedirect('/login');
    }
    
    // check access to series
    /** @test */
    public function only_logged_series_access()
    {
        $response = $this->get('/series')->assertRedirect('/login');
    }

    // check access to seasons
    /** @test */
    public function only_logged_seasons_access()
    {
        $response = $this->get('/seasons')->assertRedirect('/login');
    }
}