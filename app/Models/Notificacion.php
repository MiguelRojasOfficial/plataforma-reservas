<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notificacion extends Model
{
    use HasFactory;

    protected $table = 'notificaciones';

    protected $fillable = ['usuario_id', 'tipo', 'mensaje', 'leida'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
