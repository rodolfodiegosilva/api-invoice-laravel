<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('emitirnotafiscal', 'App\Http\Controllers\Api\NfeController@emitirnotafiscal');
Route::post('emitirnotafiscaldevolucao', 'App\Http\Controllers\Api\NfeController@emitirnotafiscaldevolucao');
Route::post('emitirnotafiscalajuste', 'App\Http\Controllers\Api\NfeController@emitirnotafiscalajuste');
Route::post('emitirnotafiscalcomplementar', 'App\Http\Controllers\Api\NfeController@emitirnotafiscalcomplementar');
Route::get('statusSefaz', 'App\Http\Controllers\Api\NfeController@statusSefaz');
Route::get('consultarnotafiscal', 'App\Http\Controllers\Api\NfeController@consultarnotafiscal');
Route::put('cancelarnotafiscal', 'App\Http\Controllers\Api\NfeController@cancelarnotafiscal');
Route::put('inutilizarnotafiscal', 'App\Http\Controllers\Api\NfeController@inutilizarnotafiscal');
Route::get('validadecertificado', 'App\Http\Controllers\Api\NfeController@validadecertificado');
