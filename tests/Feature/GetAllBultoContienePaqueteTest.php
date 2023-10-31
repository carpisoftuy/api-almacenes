<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetAllBultoContienePaqueteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    public function testGetBultoContiene() {
        $response = $this->get('/api/v2/asignar/paquetes/');
        $response->assertStatus(200);
    } 

}
