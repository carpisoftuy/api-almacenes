<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Almacen;    

class GetAlmacenPorIdTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetAlmacenPorSuIdCorrecta() {
        
        $almacen = Almacen::create([
            'espacio' => 3020,
            'espacio_ocupado' => 1000,
            'id_ubicacion' => 1
        ]);

        $response = $this->get("/api/v2/almacenes/{$almacen->id}");

        $response->assertStatus(200);

        $response->assertJson([
            'id' => $almacen->id,
            'espacio' => $almacen->espacio,
            'espacio_ocupado' => $almacen->espacio_ocupado,
            'id_ubicacion' => $almacen->id_ubicacion,
        ]);

        $almacen->delete();

    }   
}
