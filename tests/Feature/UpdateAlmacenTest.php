<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Almacen;

class UpdateAlmacenTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUpdateBulto(){

        $almacen = Almacen::create([
            'espacio' => 3020,
            'espacio_ocupado' => 1000,
            'id_ubicacion' => 1
        ]);

        $nuevoEspacio = 15;
        $nuevoEspacioOcupado = 8;
        $nuevoIdUbicacion = 2;

        $response = $this->put("/api/v2/almacenes/{$almacen->id}", [
            'espacio' => $nuevoEspacio,
            'espacio_ocupado' => $nuevoEspacioOcupado,
            'id_ubicacion' => $nuevoIdUbicacion,
        ]);

        $response->assertStatus(200);

        // Verifica que los datos del almacen actualizado coincidan con los nuevos datos
        $this->assertEquals($nuevoEspacio, $almacen->fresh()->espacio);
        $this->assertEquals($nuevoEspacioOcupado, $almacen->fresh()->espacio_ocupado);
        $this->assertEquals($nuevoIdUbicacion, $almacen->fresh()->id_ubicacion);

        $almacen->delete();

    }
}
