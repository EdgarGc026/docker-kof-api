<?php

namespace App\Http\Controllers\Scraping;

use App\Http\Controllers\Controller;
use App\Services\Character\CharacterService;

class CharacterScrapingController extends Controller {
 public function characterSync(CharacterService $characterService) {
  $characterService->characterSync();
 }

 public function characterScraping(CharacterService $characterService) {
  $characterService->characterScraping();
 }

 //De testeo
 public function singleCharacter(CharacterService $characterService) {
  $characterService->singleCharacter();
 }

 //De testeo
 public function remainingCharacters(CharacterService $characterService) {
  $characterService->remainingCharacters();
 }
}
