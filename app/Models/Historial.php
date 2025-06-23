<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    protected $fillable = [
        'reserva_id',
        'accion',
        'detalles',
    ];
}