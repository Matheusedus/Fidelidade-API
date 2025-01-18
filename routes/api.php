<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TransacaoController;
use App\Http\Controllers\RecompensaController;

Route::prefix('clientes')->group(function () {
    Route::post('/', [ClienteController::class, 'cadastrarCliente']); 
    Route::get('/{id}', [ClienteController::class, 'mostrarCliente']); 
    Route::get('/', [ClienteController::class, 'exibirClientes']); 
    Route::get('/{id}/saldo', [ClienteController::class, 'exibirSaldo']); 
    Route::post('/{id}/resgatar', [RecompensaController::class, 'resgatar']); 
    Route::post('/{id}/pontuar', [TransacaoController::class, 'pontuar']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
