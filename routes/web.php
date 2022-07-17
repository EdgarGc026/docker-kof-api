<?php

use App\Http\Controllers\Queue\ScrapingQueueController;
use App\Http\Controllers\Scraping\WikiScrapingController;
use App\Http\Controllers\Web\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('welcome');});

Route::get('/home', [HomeController::class, 'index'])->name('home.index');
// Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('home.dashboard');

//Para obtener los atributos de los personajes a scrapear (nombre, id, url)
//Route::get('character/sync', [WikiScrapingController::class, 'characterSync'])->name('character.sync');
//Route::post('character/sync', [WikiScrapingController::class, 'characterSync'])->name('character.sync');
Route::match(['GET', 'POST'], 'wiki/sync', [WikiScrapingController::class, 'characterSync'])
 ->name('character.sync');

//Hara el scraping de los personajes
// Route::get('character/scraping', [CharacterScrapingController::class, 'characterScraping']);
// Route::post('character/scraping', [CharacterScrapingController::class, 'characterScraping']);
Route::match(['GET', 'POST'], 'character/scraping', [WikiScrapingController::class, 'characterScraping'])
 ->name('character.scraping');

/* Rutas para testeo */
//Probar por personaje
Route::get('wiki/singleScraping', [WikiScrapingController::class, 'singleCharacter']);
Route::post('wiki/singleScraping', [WikiScrapingController::class, 'singleCharacter']);

//Ruta de prueba
Route::get('wiki/remain', [WikiScrapingController::class, 'remainingCharacters']);

//Rutas de prueba
Route::any('wiki/syncQueue', [ScrapingQueueController::class, 'ButtonSync']);