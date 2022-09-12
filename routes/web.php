<?php

use App\Http\Controllers\Scraping\WikiGame\GameScrapingController;
use App\Http\Controllers\Scraping\WikiScrapingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('welcome');});

//Para obtener los atributos de los personajes a scrapear (nombre, id, url)
Route::match(['GET', 'POST'], 'wiki/sync', [WikiScrapingController::class, 'characterSync'])
 ->name('wiki.sync');

//Hara el scraping de los personajes
Route::match(['GET', 'POST'], 'wiki/scraping', [WikiScrapingController::class, 'characterScraping'])
 ->name('wiki.scraping');

Route::get('game/sync', [GameScrapingController::class, 'gameSync'])
 ->name('game.sync');

/* Rutas para testeo */
//Probar por personaje
Route::match(['GET', 'POST'], 'wiki/singleScraping', [WikiScrapingController::class, 'singleCharacter'])->name('wiki.singleScraping');

//Ruta de prueba
Route::get('wiki/remain', [WikiScrapingController::class, 'remainingCharacters'])->name('wikiRemain.scraping');
