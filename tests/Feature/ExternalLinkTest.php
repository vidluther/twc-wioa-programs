<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
//use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\ProgramSeeder;

use App\Models\Program;

use Tests\TestCase;

class ExternalLinkTest extends TestCase
{
    //use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        //$this->seed();
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_cities_page()
    {
        $response = $this->get('/cities');

        $response->assertStatus(200);
    }




}
