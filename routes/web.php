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
Route::prefix('Movimientos')->group(function () {
      Route::get('/historial', [TransferenciaController::class, 'index'])->name('mis-movimientos');

});


Route::prefix('Transacciones')->group(function () {
      Route::get('/realizadas', [transaccionesController::class, 'index'])->name('transacciones');
      Route::post('/listar', [transaccionesController::class, 'listarTransacciones'])->name('listar-transacciones');
      Route::get('/exportar', [transaccionesController::class, 'exportarCsv'])->name('exportar-csv');

});