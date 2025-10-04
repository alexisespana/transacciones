<?php

use App\Http\Controllers\Transacciones\transaccionesController;
use App\Http\Controllers\Trasferencia\TransferenciaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.Inicio');
});
Route::prefix('Transferencias')->group(function () {
      Route::get('/transferencia', [TransferenciaController::class, 'index'])->name('realizar-transferencia');
      Route::post('/Transferir', [TransferenciaController::class, 'transferir'])->name('enviar-transferencia');
});


Route::prefix('Transacciones')->group(function () {
      Route::get('/listar', [transaccionesController::class, 'index'])->name('listar-transacciones');

});