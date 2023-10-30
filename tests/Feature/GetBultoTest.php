<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetBulto extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetBultos() {
        $response = $this->get('/api/v2/bultos');
        $response->assertStatus(200);
    }   
    
}
