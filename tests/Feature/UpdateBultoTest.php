<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Bulto;

class UpdateBultoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    public function testUpdateBulto(){

        $bulto = Bulto::create([
            'volumen' => 10,
            'peso' => 5,
            'almacen_destino' => 1,
        ]);

        $nuevoVolumen = 15;
        $nuevoPeso = 8;
        $nuevoAlmacenDestino = 2;

        $response = $this->put("/api/v2/bultos/{$bulto->id}", [
            'volumen' => $nuevoVolumen,
            'peso' => $nuevoPeso,
            'almacen_destino' => $nuevoAlmacenDestino,
        ]);

        $response->assertStatus(200);

        // Verifica que los datos del bulto actualizado coincidan con los nuevos datos
        $this->assertEquals($nuevoVolumen, $bulto->fresh()->volumen);
        $this->assertEquals($nuevoPeso, $bulto->fresh()->peso);
        $this->assertEquals($nuevoAlmacenDestino, $bulto->fresh()->almacen_destino);

        $bulto->delete();

    }

     


}
