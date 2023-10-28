<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\BultoContiene;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use App\Models\Paquete;
use App\Models\PaqueteParaRecoger;
use App\Models\PaqueteParaEntregar;
use App\Models\Ubicacion;
use App\Models\AlmacenContieneBulto;
use App\Models\AlmacenContieneBultoFin;
use Illuminate\Support\Facades\DB;

class PaqueteController extends Controller
{   
    
    public function GetPaquetes(Request $request){
        $paquetes = Paquete::all();

        foreach( $paquetes as $paquete ){

            if(BultoContiene::leftJoin('bulto_contiene_fin', 'bulto_contiene_fin.id', '=',  'bulto_contiene.id')
            ->where('bulto_contiene.id_paquete', '=', $paquete->id)
            ->where('bulto_contiene_fin.id', '=', null)
            ->exists()){
                $paquete->bulto = BultoContiene::leftJoin('almacen_contiene_bulto','almacen_contiene_bulto.id_bulto','=','bulto_contiene.id_bulto')
                ->join('paquete', 'paquete.id', '=', 'bulto_contiene.id_paquete') 
                ->select('bulto_contiene.id_bulto')
                ->where('paquete.id', '=', $paquete->id)
                ->where('bulto_contiene.id_bulto','!=', null)
                ->first()
                ->id_bulto;
                if(AlmacenContieneBulto::leftJoin('almacen_contiene_bulto_fin', 'almacen_contiene_bulto_fin.id', '=', 'almacen_contiene_bulto.id')
                ->where('almacen_contiene_bulto.id_bulto', '=', $paquete->bulto)
                ->where('almacen_contiene_bulto_fin.id', '=', null)
                ->exists()                
                ){
                    $paquete->almacen = AlmacenContieneBulto::leftJoin('almacen_contiene_bulto_fin', 'almacen_contiene_bulto_fin.id', '=', 'almacen_contiene_bulto.id')
                    ->join('almacen', 'almacen.id', '=', 'almacen_contiene_bulto.id_almacen')
                    ->join('ubicacion', 'almacen.id_ubicacion', '=', 'ubicacion.id')
                    ->where('almacen_contiene_bulto.id_bulto', '=', $paquete->bulto)
                    ->where('almacen_contiene_bulto_fin.id', '=', null)
                    ->select('almacen_contiene_bulto.id_almacen', 'ubicacion.*')
                    ->first();
                }

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

            if(Paquete::join('almacen_contiene_paquete','almacen_contiene_paquete.id_paquete','=','paquete.id')
            ->where('paquete.id', '=', $paquete->id)
            ->leftJoin('almacen_contiene_paquete_fin','almacen_contiene_paquete_fin.id','=','almacen_contiene_paquete.id')
            ->where('almacen_contiene_paquete_fin.id','=', null)
            ->exists()){
                $paquete->almacen =
                Paquete::join('almacen_contiene_paquete','almacen_contiene_paquete.id_paquete','=','paquete.id')
                ->where('paquete.id', '=', $paquete->id)
                ->leftJoin('almacen_contiene_paquete_fin','almacen_contiene_paquete_fin.id','=','almacen_contiene_paquete.id')
                ->where('almacen_contiene_paquete_fin.id','=', null)
                ->join('almacen', 'almacen.id', '=', 'almacen_contiene_paquete.id_almacen')
                ->join('ubicacion', 'almacen.id_ubicacion', '=', 'ubicacion.id')
                ->select('almacen.*', 'ubicacion.*')
                ->first();
                
            }

        }

        return $paquetes;

    }

    public function GetPaquete(Request $request){
        return Paquete::find($request->id);
    }

    public function CreatePaquete(Request $request){
        DB::beginTransaction();
        $paquete = new Paquete();
        $paquete->fecha_despacho = now();
        $paquete->volumen = $request->post('volumen');
        $paquete->peso = $request->post('peso');
        $paquete->save();

        if($request->post('tipo') == 'entregar'){
            $ubicacion = new Ubicacion();
            $ubicacion->direccion = $request->direccion;
            $ubicacion->codigo_postal = $request->codigo_postal;
            $ubicacion->latitud = $request->latitud;
            $ubicacion->longitud = $request->longitud;
            $ubicacion->save();

            $paqueteParaEntregar = new PaqueteParaEntregar();
            $paqueteParaEntregar->id = $paquete->id;
            $paqueteParaEntregar->ubicacion_destino = $ubicacion->id;
            $paqueteParaEntregar->save();
        }
        DB::commit();
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
