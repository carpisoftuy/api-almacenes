<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Almacen;

class DeleteAlmacenTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDeleteAlmacenCorrectamente(){

        $almacen = Almacen::create([
            'espacio' => 3020,
            'espacio_ocupado' => 1000,
            'id_ubicacion' => 1
       ]);
   
       $response = $this->delete("/api/v2/almacenes/{$almacen->id}");
       $response->assertStatus(200);
   
       }
   
       public function testDeleteAlmacenConIdIncorrecta(){
   
           $almacen = Almacen::create([
                'espacio' => 3020,
                'espacio_ocupado' => 1000,
                'id_ubicacion' => 1
          ]);
   
          $id_incorrecta = "ads";
      
          $response = $this->delete("/api/v2/almacenes/{$id_incorrecta}");
          $response->assertStatus(500);
   
          $almacen->delete();
   
          }
}
