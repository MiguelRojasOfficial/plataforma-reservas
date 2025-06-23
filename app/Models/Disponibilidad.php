<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disponibilidad extends Model
{
	use HasFactory;

	protected $table = 'disponibilidades';

	protected $fillable = ['fecha', 'hora_inicio', 'hora_fin'];

	protected static function booted()
	{
		static::updated(function ($disponibilidad) {
        	if ($disponibilidad->wasChanged(['estado', 'fecha', 'hora'])) {
            	Notification::route('mail', 'admin@tuweb.com')
                	->notify(new CambioDisponibilidadNotification($disponibilidad));
        	}
    	});
	}

	public function sede()
	{
	    return $this->belongsTo(Sede::class);
	}
}