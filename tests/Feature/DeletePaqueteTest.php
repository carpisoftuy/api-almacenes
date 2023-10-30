<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Paquete;

class DeletePaqueteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
        public function testDeletePaqueteCorrectamente(){

            $paquete = Paquete::create([
            'volumen' => 10,
            'peso' => 5,
        ]);
    
        $response = $this->delete("/api/v2/paquetes/{$paquete->id}");
        $response->assertStatus(200);
    
        }
   
       public function testDeletePaqueteConIdIncorrecta(){
   
           $paquete = Paquete::create([
              'volumen' => 10,
              'peso' => 5,
          ]);
   
          $id_incorrecta = "ads";
      
          $response = $this->delete("/api/v2/paquetes/{$id_incorrecta}");
          $response->assertStatus(500);
   
          $paquete->delete();
   
          }
}
