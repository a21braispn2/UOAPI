<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



// Esto genera automáticamente el CRUD completo (index, store, show, update, destroy)
Route::apiResource('projects', ProjectController::class);