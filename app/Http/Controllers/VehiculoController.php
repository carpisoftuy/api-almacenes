<?php

namespace App\Http\Controllers;

use App\Models\AlmacenContieneBultoFin;
use App\Models\AlmacenContieneBulto;
use App\Models\AlmacenContienePaquete;
use App\Models\AlmacenContienePaqueteFin;
use Illuminate\Http\Request;
use App\Models\Camion;
use App\Models\Vehiculo;
use App\Models\CargaBulto;
use App\Models\CargaBultoFin;
use App\Models\CargaPaquete;
use App\Models\CargaPaqueteFin;

class VehiculoController extends Controller
{
    
    public function GetCamiones(Request $request){
        
        $vehiculos = Vehiculo::join("camion","vehiculo.id","=","camion.id")
        ->get();

        return $vehiculos;

    }

    public function GetCamionetas(Request $request){
        
        $vehiculos = Vehiculo::join("camioneta","vehiculo.id","=","camioneta.id")
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

    public function CargarPaqueteACamioneta(Request $request){

        $cargaPaquete = new CargaPaquete();
        $cargaPaquete->id_vehiculo = $request->id_vehiculo;
        $cargaPaquete->id_paquete = $request->id_paquete;
        $cargaPaquete->save();

        $id_almacen_contiene_paquete = AlmacenContienePaquete::where("id_paquete", "=", $request->id_paquete)->leftJoin("almacen_contiene_paquete_fin","almacen_contiene_paquete_fin.id","=","almacen_contiene_paquete.id")
        ->select("almacen_contiene_paquete.id")->first()->id;

        $almacen_contiene_paquete_fin = new AlmacenContienePaqueteFin();
        $almacen_contiene_paquete_fin->id = $id_almacen_contiene_paquete;
        $almacen_contiene_paquete_fin->save();

    }

}
