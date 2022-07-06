<?php

use App\Http\Controllers\Scraping\CharacterScrapingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
 return view('welcome');
});

//Para obtener los atributos de los personajes a scrapear (nombre, id, url)
Route::get('character/sync', [CharacterScrapingController::class, 'characterSync']);
Route::post('character/sync', [CharacterScrapingController::class, 'characterSync']);

//Hara el scraping de los personajes
Route::get('character/scraping', [CharacterScrapingController::class, 'characterScraping']);
Route::post('character/scraping', [CharacterScrapingController::class, 'characterScraping']);

/* Rutas para testeo */

//Probar por personaje
Route::get('character/singleScraping', [CharacterScrapingController::class, 'singleCharacter']);
Route::post('character/singleScraping', [CharacterScrapingController::class, 'singleCharacter']);

//Ruta de prueba
Route::get('character/remain', [CharacterScrapingController::class, 'remainingCharacters']);