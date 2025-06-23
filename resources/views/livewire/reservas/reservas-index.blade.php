@extends('layouts.app')

@section('content')

<div class="container mt-4">
	<h2 class="mb-3">Mis Reservas</h2>
	@if (session()->has('message'))
		<div class="alert alert-success">{{ session('message') }}</div>
	@endif

	<div class="d-flex justify-content-between mb-3">
		<input type="text" class="form-control w-40" placeholder="Buscar por fecha u hora" wire:model.debounce.300ms="search">
		<a href="{{ route('reservas.create') }}" class="btn btn-primary ms-3">Nueva Reserva</a>
	</div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Fecha</th>
				<th>Hora</th>
				<th>Acciones</th>
			</tr>	
		</thead>
		<tbody>
			@forelse ($reservas as $reserva)
				<tr>
					<td>{{ $reserva->fecha }}</td>
					<td>{{ $reserva->hora }}</td>
					<td>
						<a href="{{ route('reservas.edit', $reserva->id) }}" class="btn btn-sm btn-success">Editar</a>
						<button wire:click="eliminar({{ $reserva->id }})" class="btn btn-sm btn-danger">Eliminar</button>
					</td>	
				</tr>	
			@endforelse
		</tbody>	
	</table>

	<div class="modal-body">
	    <p>¿Estás seguro que deseas cancelar esta reserva? Esta acción no se puede deshacer.</p>
	    <div class="mb-3">
	        <label for="motivoCancelacion" class="form-label">Motivo de cancelación</label>
	        <textarea wire:model.defer="motivoCancelacion" id="motivoCancelacion" class="form-control" rows="3" required></textarea>
	    </div>
	</div>
</div>
@endsection