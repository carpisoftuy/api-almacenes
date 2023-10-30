<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Paquete;    

class CrearPaqueteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreatePaqueteCorrectamente() {
        $response = $this->post('/api/v2/paquetes', [

            'peso' => 50,
            'volumen' => 48,

        ]);

        $response->assertStatus(200);

        $paqueteCreadoId = Paquete::latest('id')->first()->id;

        if ($paqueteCreadoId) {
            Paquete::destroy($paqueteCreadoId);
        }

    }

    public function testCreatePaqueteSinDatos() {
        $response = $this->post('/api/v2/paquetes', [
            'peso' => "",
            'volumen' => "",
        ]);

        $response->assertStatus(500);

    }

    public function testCreatePaqueteConDatoIncorrecto() {
        $response = $this->post('/api/v2/paquetes', [
            'peso' => "adas",
            'volumen' => "asdsad",
        ]);

        $response->assertStatus(500);

    }
}
