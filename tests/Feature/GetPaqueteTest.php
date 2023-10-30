<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetPaqueteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
     public function testGetPaquetes() {
        $response = $this->get('/api/v2/paquetes');
        $response->assertStatus(200);
    }  
}
