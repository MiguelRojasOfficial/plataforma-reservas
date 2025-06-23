<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sede extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'capacidad_maxima',
    ];

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'sede_id');
    }
}