<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Almacen;
use App\Models\Ubicacion;

class DeleteUbicacionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDeleteUbicacionCorrectamente(){

        $ubicacion = Ubicacion::create([
        'direccion' => "vilardebo 2024",
        'codigo_postal' => "11800",
        'latitud' => -34.87958216,
        'longitud' => -56.17532811,
    ]);

    $response = $this->delete("/api/v2/ubicaciones/{$ubicacion->id}");
    $response->assertStatus(200);

    }

   public function testDeleteUbicacionConIdIncorrecta(){

       $ubicacion = Ubicacion::create([
        'direccion' => "vilardebo 2024",
        'codigo_postal' => "11800",
        'latitud' => -34.87958216,
        'longitud' => -56.17532811,
      ]);

      $id_incorrecta = "ads";
  
      $response = $this->delete("/api/v2/ubicaciones/{$id_incorrecta}");
      $response->assertStatus(500);

      $ubicacion->delete();

      }
}
