<?php

namespace App\Http\Controllers;

use App\Models\BultoContiene;
use Illuminate\Http\Request;
use App\Models\Paquete;
use App\Models\PaqueteParaRecoger;
use App\Models\PaqueteParaEntregar;
use App\Models\Ubicacion;

class PaqueteController extends Controller
{   
    
    public function GetPaquetes(Request $request){
        $paquetes = Paquete::all();

        foreach( $paquetes as $paquete ){

            if(BultoContiene::where('id', '=', $paquete->id)->exists()){
                $paquete->bulto = BultoContiene::join('paquete','paquete.id','=','bulto_contiene.id_paquete')
                ->select("bulto_contiene.id_bulto")
                ->first()
                ->id_bulto;
            }

            if (PaqueteParaEntregar::where('id', '=', $paquete->id)->exists()) {
                $paquete->ubicacion = Ubicacion::join('paquete_para_entregar','paquete_para_entregar.ubicacion_destino', '=','ubicacion.id')
                ->join('paquete', 'paquete.id', '=', 'paquete_para_entregar.id')
                ->select('ubicacion.*')
                ->where('paquete.id','=', $paquete->id)
                ->first();
            }

            if (PaqueteParaRecoger::where('id', '=', $paquete->id)->exists()) {
                $paquete->ubicacion = Ubicacion::join('almacen','almacen.id_ubicacion', '=','ubicacion.id')
                ->join('paquete_para_recoger','paquete_para_recoger.almacen_destino','=','almacen.id')
                ->join('paquete', 'paquete.id', '=', 'paquete_para_recoger.id')
                ->select('ubicacion.*')
                ->where('paquete.id','=', $paquete->id)
                ->first();
            }

        }

        return $paquetes;

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
