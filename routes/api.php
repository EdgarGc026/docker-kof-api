<?php

use App\Http\Controllers\Scraping\CharacterScraping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
 return $request->user();
});

//Para obtener los atributos de los personajes a scrapear (nombre, id, url)
Route::get('/characterSync', [CharacterScraping::class, 'characterSync']);
Route::post('/characterSync', [CharacterScraping::class], 'characterSync');

//Hara el scraping de los personajes
Route::get('/characterScraping', [CharacterScraping::class, 'characterScraping']);
Route::post('/characterScraping', [CharacterScraping::class, 'characterScraping']);

//Probar por personaje
Route::get('/singleCharacter', [CharacterScraping::class, 'singleCharacter']);
Route::post('/singleCharacter', [CharacterScraping::class, 'singleCharacter']);