<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bulto;
use App\Models\BultoDesarmado;

class BultosController extends Controller
{
    public function GetBultos(Request $request){
        return Bulto::leftJoin('bulto_desarmado', 'bulto.id', '=', 'bulto_desarmado.id')
        ->select('bulto.*')
        ->where('bulto_desarmado.id', '=', null)
        ->where('bulto.id', '!=', null)
        ->get();
    }

    public function GetBulto(Request $request){
        return Bulto::find($request->id);
    }

    public function CreateBulto(Request $request){
        $bulto = new Bulto();
        $bulto->fecha_armado = now();
        $bulto->volumen = $request->post('volumen');
        $bulto->peso = $request->post('peso');
        $bulto->almacen_destino = $request->post('almacen_destino');
        $bulto->save();
        return Bulto::find($bulto->id);
    }
    public function UpdateBulto(Request $request){
        $bulto = Bulto::find($request->id);
        $bulto->volumen = $request->post('volumen');
        $bulto->peso = $request->post('peso');
        $bulto->almacen_destino = $request->post('almacen_destino');
        $bulto->save();
        return Bulto::find($request->id);
    }
    public function DeleteBulto(Request $request){
        $bultoDesarmado = new BultoDesarmado();
        $bultoDesarmado->id = $request->id;
        $bultoDesarmado->fecha_desarmado = now();
        $bultoDesarmado->save();
        
    }
}
