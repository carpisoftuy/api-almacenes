<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaqueteParaRecoger extends Model
{
    use HasFactory;

    protected $table = "paquete_para_recoger";

    public $timestamps = false;
    protected $fillable = [

        "id",
        "almacen_destino"

    ];

}
