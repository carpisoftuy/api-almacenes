<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paquete;

class PaqueteController extends Controller
{   
    
    public function GetPaquetes(Request $request){
        return Paquete::all();
    }

    public function GetPaquete(Request $request){
        return Paquete::find($request->id);
    }

    public function CreatePaquete(Request $request){
        $paquete = new Paquete();
        $paquete->fecha_despacho = now();
        $paquete->volumen = $request->post('volumen');
        $paquete->peso = $request->post('peso');
        $paquete->save();
        return Paquete::find($paquete->id);
    }

    public function UpdatePaquete(Request $request){
        $paquete = Paquete::find($request->id);
        $paquete->volumen = $request->post('volumen');
        $paquete->peso = $request->post('peso');
        $paquete->save();
        return Paquete::find($request->id);
    }

    public function DeletePaquete(Request $request){ 
        $paquete = Paquete::find($request->id);
        $paquete->delete();
    }
    
}
