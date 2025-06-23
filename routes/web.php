<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\DashboardAdmin;
use App\Livewire\DashboardUsuario;
use App\Livewire\AdminReservas;
use App\Livewire\MisReservas;
use App\Livewire\ConfirmarCuenta;
use App\Models\Reserva;
use App\Livewire\FuncionesTeatro;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Admin\Disponibilidades;
use App\Livewire\Reservas\ReservaForm;
use App\Livewire\Reservas\ReservasIndex;
use App\Livewire\Reservas\ReservasEdit;
use App\Livewire\Reservas\CrearReserva;

Route::get('/login/{key?}', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
Route::get('/forgot-password', ForgotPassword::class)->name('password.request');
Route::get('/reset-password/{token}/{email}', ResetPassword::class)->name('password.reset');
Route::get('confirmar-cuenta/{token}', ConfirmarCuenta::class)->name('confirmar.cuenta');

Route::middleware('auth')->group(function () {
    Route::get('/redirigir-usuario', function () {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('usuario.dashboard');
    })->middleware('auth')->name('redirigir-usuario');

    Route::get('/admin/dashboard', DashboardAdmin::class)->name('admin.dashboard');
    Route::get('/usuario/dashboard', DashboardUsuario::class)->name('usuario.dashboard');


    Route::post('/logout', function () {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login', ['key' => now()]);
    })->name('logout');

    Route::get('/reservas', ReservasIndex::class)->name('reservas.index');
    Route::get('/reservas/crear', CrearReserva::class)->name('reservas.create');
    Route::get('/reservas/{reserva}/edit', ReservasEdit::class)->name('reservas.edit');
    Route::get('/reservar', CrearReserva::class)->name('reservar');
    Route::get('/admin/reservas', \App\Livewire\AdminReservas::class)->middleware('can:admin')->name('admin.reservas');
    Route::get('/mis-reservas', \App\Livewire\MisReservas::class)->middleware('auth')->name('mis.reservas');
    Route::get('/disponibilidades', Disponibilidades::class)->name('disponibilidades.index');

    Route::get('/crear-reserva/{titulo}', CrearReserva::class)->name('crear-reserva');

});

Route::middleware(['auth', 'can:isAdmin'])->group(function () {
    Route::get('/admin/notificaciones', \App\Livewire\Admin\Notifications::class)->name('admin.notificaciones');
});

Route::post('/notificaciones/leidas', function () {
    Auth::user()->unreadNotifications->markAsRead();
    return back();
})->name('notificaciones.leer');

Route::get('/funciones-teatro', FuncionesTeatro::class)->name('funciones-teatro');