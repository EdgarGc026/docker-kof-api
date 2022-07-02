<?php

namespace App\Services\Character;

use App\Http\Controllers\Scraping\CharacterScrapingController;
use App\Services\Character\CharacterSyncService;

class CharacterService {
 public function characterSync(): void {
  $characterSync = new CharacterSyncService();
  $characterSync->sync();
 }

 public function characterScraping() {
  $characterScraping = new CharacterScrapingController();
  $characterScraping->scraping();
 }

 public function singleCharacter() {
  $singleCharacterScraping = new CharacterScrapingController();
  $singleCharacterScraping->singleCharacter('https://kof.fandom.com/es/wiki/Zero_(clon)');
 }

}