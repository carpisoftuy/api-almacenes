<?php

namespace Tests\Feature;

use App\Models\AlmacenContieneBulto;
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
            'almacen_origen' => 1,
        ]);

        $response->assertStatus(200);

        $bultoCreadoId = Bulto::latest('id')->first()->id;
        $almacenContieneId = AlmacenContieneBulto::latest('id')->first()->id;

        if ($almacenContieneId) {
            // Elimina el bulto al final de la prueba
            AlmacenContieneBulto::destroy($almacenContieneId);
        }

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
            'almacen_origen' => "",
        ]);

        $response->assertStatus(500);

    }

    public function testCreateBultoConDatoIncorrecto() {
        $response = $this->post('/api/v2/bultos', [
            'volumen' => "jaja",
            'peso' => "dsadss",
            'almacen_destino' => 2,
            'almacen_origen' => ["sda", !"234"],
        ]);

        $response->assertStatus(500);

    }


}
