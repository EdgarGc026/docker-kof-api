<?php

use App\Http\Controllers\Scraping\CharacterScrapingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
 return view('welcome');
});

//Para obtener los atributos de los personajes a scrapear (nombre, id, url)
Route::get('/characterSync', [CharacterScrapingController::class, 'characterSync']);
Route::post('/characterSync', [CharacterScrapingController::class], 'characterSync');

//Ruta de prueba
Route::get('/remainingCharacters', [CharacterScrapingController::class], 'remainingCharacters');
//Route::post('/remainingCharacters', [CharacterScrapingController::class], 'remainingCharacters');

//Hara el scraping de los personajes
Route::get('/characterScraping', [CharacterScrapingController::class, 'characterScraping']);
Route::post('/characterScraping', [CharacterScrapingController::class, 'characterScraping']);

//Probar por personaje
Route::get('/singleCharacter', [CharacterScrapingController::class, 'singleCharacter']);
Route::post('/singleCharacter', [CharacterScrapingController::class, 'singleCharacter']);