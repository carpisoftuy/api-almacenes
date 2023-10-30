<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Bulto;

class CrearBulto extends TestCase
{
    /**
     * Prueba la creación de un bulto.
     *
     * @return void
     */
    public function testCreateBultoCorrectamente() {
        $response = $this->post('/api/v2/bultos', [
            'volumen' => 10,
            'peso' => 5,
            'almacen_destino' => 2,
        ]);

        $response->assertStatus(200);

        $bultoCreadoId = Bulto::latest('id')->first()->id;

        if ($bultoCreadoId) {
            // Elimina el bulto al final de la prueba
            Bulto::destroy($bultoCreadoId);
        }

    }

    public function testCreateBultoSinDatos() {
        $response = $this->post('/api/v2/bultos', [
            'volumen' => "",
            'peso' => "",
            'almacen_destino' => "",
        ]);

        $response->assertStatus(500);

    }

    public function testCreateBultoConDatoIncorrecto() {
        $response = $this->post('/api/v2/bultos', [
            'volumen' => "jaja",
            'peso' => "dsadss",
            'almacen_destino' => 2,
        ]);

        $response->assertStatus(500);

    }


}
