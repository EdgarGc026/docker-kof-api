<?php

namespace App\Http\Controllers\Scraping;

use App\Http\Controllers\Controller;
use App\Services\WikiCharacter\WikiService;

class WikiScrapingController extends Controller {
 public function characterSync(WikiService $wikiService): void {
  $wikiService->characterSync();
 }

 public function characterScraping(WikiService $wikiService): void {
  $wikiService->characterScraping();
 }

 //De testeo
 public function singleCharacter(WikiService $wikiService): void {
  $wikiService->singleCharacter();
 }

 //De testeo
 public function remainingCharacters(WikiService $wikiService): void {
  $wikiService->remainingCharacters();
 }
}
