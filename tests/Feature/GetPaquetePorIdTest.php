<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Paquete;

class GetPaquetePorIdTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetPaquetePorSuIdCorrecta() {
        
        $paquete = Paquete::create([
            'peso' => 50,
            'volumen' => 48,
        ]);

        $response = $this->get("/api/v2/paquetes/{$paquete->id}");

        $response->assertStatus(200);

        $response->assertJson([
            'volumen' => $paquete->volumen,
            'peso' => $paquete->peso,
        ]);

        $paquete->delete();

    }   
}
