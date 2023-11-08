<?php

namespace App\Http\Controllers;

use App\Models\AlmacenContieneBulto;
use Illuminate\Http\Request;
use App\Models\Bulto;
use App\Models\BultoDesarmado;
use App\Models\BultoContiene;
use App\Models\BultoContieneFin;


class BultosController extends Controller
{
    public function GetBultos(Request $request){
        return Bulto::leftJoin('bulto_desarmado', 'bulto.id', '=', 'bulto_desarmado.id')
        ->join('almacen_contiene_bulto' ,'almacen_contiene_bulto.id_bulto','=','bulto.id')
        ->join('almacen as almacen_actual','almacen_actual.id','=','almacen_contiene_bulto.id_almacen')
        ->join('almacen as almacen_destino','almacen_destino.id','=','bulto.almacen_destino')
        ->join('ubicacion as ubicacion_actual','ubicacion_actual.id','=','almacen_actual.id_ubicacion')
        ->join('ubicacion as ubicacion_destino','ubicacion_destino.id','=','almacen_destino.id_ubicacion')
        ->select('bulto.*','ubicacion_actual.direccion as direccion_actual', 'ubicacion_actual.codigo_postal as codigo_postal_actual', 'ubicacion_destino.direccion as direccion_destino', 'ubicacion_destino.codigo_postal as codigo_postal_destino', 'bulto.id')
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

        //mete automaticamente el bulto en el almacen donde se creo
        $almacenContieneBulto = new AlmacenContieneBulto();
        $almacenContieneBulto->id_bulto = $bulto->id;
        $almacenContieneBulto->id_almacen = $request->almacen_origen;
        $almacenContieneBulto->fecha_inicio = now();
        $almacenContieneBulto->save();

        return [Bulto::find($bulto->id), AlmacenContieneBulto::find($almacenContieneBulto->id)];
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

    //relacion bulto-paquete

    public function GetAllBultoContienePaquete(Request $request){
        return BultoContiene::leftJoin('bulto_contiene_fin', 'bulto_contiene.id', '=', 'bulto_contiene_fin.id')
        ->select('bulto_contiene.*')
        ->where('bulto_contiene_fin.id', '=', null)
        ->where('bulto_contiene.id', '!=', null)
        ->get();
    }

    public function GetBultoContienePaquete(Request $request){
        return BultoContiene::find($request->id);
    }

    public function CreateBultoContienePaquete(Request $request){
        $bultoContiene = new BultoContiene();
        $bultoContiene->id_paquete = $request->id_paquete;
        $bultoContiene->id_bulto = $request->id_bulto;
        $bultoContiene->save();
        return BultoContiene::find($bultoContiene->id);
    }

    public function UpdateBultoContienePaquete(Request $request){
        $bultoContiene = BultoContiene::find($request->id);
        $bultoContiene->id_paquete = $request->id_paquete;
        $bultoContiene->id_bulto = $request->id_bulto;
        $bultoContiene->save();
        return BultoContiene::find($bultoContiene->id);
    }
    public function DeleteBultoContienePaquete(Request $request){
        $bultoContiene = new BultoContieneFin();
        $bultoContiene->id = $request->id;
        $bultoContiene->fecha_fin = now();
        $bultoContiene->save();
    }




}
