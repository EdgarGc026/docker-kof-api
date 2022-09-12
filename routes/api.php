<?php

use App\Http\Controllers\Api\v1\CharacterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
 return $request->user();
});

//api/v1
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\v1'], function () {
 Route::apiResource('characters', CharacterController::class);
});