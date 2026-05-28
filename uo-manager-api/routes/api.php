<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('api');
});

Route::get('/docs', function () {
    return view('docs');
});

Route::get('/debug', function () {
    return response()->json([
        'message' => 'Debug route is working!',
        'timestamp' => now(),
    ]);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('projects', ProjectController::class);