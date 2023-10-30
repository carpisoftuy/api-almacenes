<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Bulto;

class GetBultoPorIdTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetBultoPorSuIdCorrecta() {
        
        $bulto = Bulto::create([
            'volumen' => 10,
            'peso' => 5,
            'almacen_destino' => 1,
        ]);

        $response = $this->get("/api/v2/bultos/{$bulto->id}");

        $response->assertStatus(200);

        $response->assertJson([
            'id' => $bulto->id,
            'volumen' => $bulto->volumen,
            'peso' => $bulto->peso,
            'almacen_destino' => $bulto->almacen_destino,
        ]);

    }   
    
}
