<?php

namespace App\Services\Character;

use App\Services\Character\CharacterScrapingService;
use App\Services\Character\CharacterSyncService;

class CharacterService {
 public function characterSync(): void {
  $characterSync = new CharacterSyncService();
  $characterSync->sync();
 }

 public function characterScraping(): void {
  $characterScraping = new CharacterScrapingService();
  $characterScraping->scraping();
 }

 //De testeo
 public function singleCharacter(): void {
  $singleCharacterScraping = new CharacterScrapingService();
  $singleCharacterScraping->singleCharacter("https://kof.fandom.com/es/wiki/Zero_(NESTS)");
 }

 //De testeo
 public function remainingCharacters(): void {
  $characterSync = new CharacterSyncService();
  $characterSync->characterFourthPart();
 }
}