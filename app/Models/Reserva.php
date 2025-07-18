<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
	use HasFactory;
	protected $fillable = [
		'user_id',
		'sede_id',
		'fecha',
		'hora',
		'detalle',
		'estado'
	];

	public function user()
	
	{
		return $this->belongsTo(User::class);
	}

	public function sede()
	{
	    return $this->belongsTo(Sede::class);
	}

}