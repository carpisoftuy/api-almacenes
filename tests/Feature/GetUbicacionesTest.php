<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Ubicacion;    

class GetUbicacionesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetUbicacionPorSuIdCorrecta() {
        
        $ubicacion = Ubicacion::create([
            'direccion' => "vilardebo 2024",
            'codigo_postal' => "11800",
            'latitud' => -34.87958216,
            'longitud' => -56.17532811,
        ]);

        $response = $this->get("/api/v2/ubicaciones/{$ubicacion->id}");

        $response->assertStatus(200);

        $response->assertJson([
            'direccion' => $ubicacion->direccion,
            'codigo_postal' => $ubicacion->codigo_postal,
            'latitud' => $ubicacion->latitud,
            'longitud' => $ubicacion->longitud,
        ]);

        $ubicacion->delete();

    }   
}
