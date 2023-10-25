<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaqueteParaEntregar extends Model
{
    use HasFactory;

    protected $table = "paquete_para_entregar";

    public $timestamps = false;
    protected $fillable = [

        "id",
        "ubicacion_destino"

    ];

}
