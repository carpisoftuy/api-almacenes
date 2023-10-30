<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

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
    }


}
