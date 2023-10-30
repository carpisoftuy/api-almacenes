<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Bulto;

class DeleteBultoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    public function testDeleteBultoCorrectamente(){

     $bulto = Bulto::create([
        'volumen' => 10,
        'peso' => 5,
        'almacen_destino' => 1,
    ]);

    $response = $this->delete("/api/v2/bultos/{$bulto->id}");
    $response->assertStatus(200);

    }

    public function testDeleteBultoConIdIncorrecta(){

        $bulto = Bulto::create([
           'volumen' => 10,
           'peso' => 5,
           'almacen_destino' => 1,
       ]);

       $id_incorrecta = "ads";
   
       $response = $this->delete("/api/v2/bultos/{$id_incorrecta}");
       $response->assertStatus(500);

       $bulto->delete();

       }

}
