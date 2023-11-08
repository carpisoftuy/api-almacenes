<?php

namespace App\Http\Controllers;

use App\Models\AlmacenContieneBultoFin;
use App\Models\AlmacenContieneBulto;
use Illuminate\Http\Request;
use App\Models\Camion;
use App\Models\Vehiculo;
use App\Models\CargaBulto;
use App\Models\CargaBultoFin;

class VehiculoController extends Controller
{
    
    public function GetCamiones(Request $request){
        
        $vehiculos = Vehiculo::join("camion","vehiculo.id","=","camion.id")
        ->get();

        return $vehiculos;

    }

    public function CargarBultoACamion(Request $request){

        $bultoCargado = new CargaBulto();
        $bultoCargado->id_vehiculo = $request->id_vehiculo;
        $bultoCargado->id_bulto = $request->id_bulto;
        $bultoCargado->save();

        $id_almacen_contiene_bulto = AlmacenContieneBulto::where("id_bulto", "=", $request->id_bulto)->leftJoin("almacen_contiene_bulto_fin","almacen_contiene_bulto_fin.id","=","almacen_contiene_bulto.id")
        ->select("almacen_contiene_bulto.id")->first()->id;

        $almacen_contiene_bulto_fin = new AlmacenContieneBultoFin();
        $almacen_contiene_bulto_fin->id = $id_almacen_contiene_bulto;
        $almacen_contiene_bulto_fin->save();

    }

}
