<?php

namespace App\Http\Controllers\Scraping;

use App\Http\Controllers\Controller;
use App\Services\Character\CharacterService;

class CharacterScraping extends Controller {
 public function characterSync(CharacterService $characterService) {
  $characterService->characterSync();
 }

 public function characterScraping(CharacterService $characterService) {
  $characterService->characterScraping();
 }

 public function singleCharacter(CharacterService $characterService) {
  $characterService->singleCharacter();
 }
}
