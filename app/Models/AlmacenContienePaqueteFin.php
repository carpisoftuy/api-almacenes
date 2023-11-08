<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlmacenContienePaqueteFin extends Model
{
    use HasFactory;

    protected $table = "almacen_contiene_paquete_fin";

    public $timestamps = false;
    protected $fillable = [

        "id"

    ];
}
