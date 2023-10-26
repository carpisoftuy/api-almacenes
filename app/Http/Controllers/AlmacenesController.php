<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Almacen;

class AlmacenesController extends Controller
{
    public function GetAlmacenes(Request $request){
        return Almacen::join('ubicacion', 'ubicacion.id', '=', 'almacen.id_ubicacion')->get();

    }

    public function GetAlmacen(Request $request){
        return Almacen::find($request->id);
    }
    
    public function CreateAlmacen(Request $request){
        $almacen = new Almacen();
        $almacen->espacio = $request->post('espacio');
        $almacen->espacio_ocupado = $request->post('espacio_ocupado');
        $almacen->id_ubicacion = $request->post('id_ubicacion');
        $almacen->save();
        return Almacen::find($request->id);
    }
    public function UpdateAlmacen(Request $request){
        $almacen = Almacen::find($request->id);
        $almacen->espacio = $request->espacio;
        $almacen->espacio_ocupado = $request->espacio_ocupado;
        $almacen->id_ubicacion = $request->id_ubicacion;
        $almacen->save();
        return Almacen::find($request->id);
    }
    public function DeleteAlmacen(Request $request){
        $almacen = Almacen::find($request->id);
        $almacen->delete();
    }
}
