<?php

/**
 * Mouhana Almouhana
 * MouhanaAlmouhana@gmail.com
 */

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Define routes for handling CRUD operations (GET, POST, PUT,DELETE) on properties

Route::get('properties', [PropertyController::class, 'index']);
Route::post('properties', [PropertyController::class, 'store']);
Route::get('properties/{id}', [PropertyController::class, 'show']);
Route::put('properties/{id}/update', [PropertyController::class, 'update']);
Route::delete('properties/{id}/destroy', [PropertyController::class, 'destroy']);
