<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Paquete;    

class UpdatePaqueteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUpdatePaquete(){

        $paquete = Paquete::create([
            'volumen' => 10,
            'peso' => 5,
        ]);

        $nuevoVolumen = 15;
        $nuevoPeso = 8;

        $response = $this->put("/api/v2/paquetes/{$paquete->id}", [
            'volumen' => $nuevoVolumen,
            'peso' => $nuevoPeso,
        ]);

        $response->assertStatus(200);

        // Verifica que los datos del paquete actualizado coincidan con los nuevos datos
        $this->assertEquals($nuevoVolumen, $paquete->fresh()->volumen);
        $this->assertEquals($nuevoPeso, $paquete->fresh()->peso);

        $paquete->delete();

    }
}
