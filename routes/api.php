<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Example of a normal route with authentication
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
