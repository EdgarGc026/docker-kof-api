<?php

namespace App\Services\WikiCharacter;

use App\Services\WikiCharacter\WikiScrapingService;
use App\Services\WikiCharacter\WikiSyncService;

class WikiService {
 public function characterSync(): void {
  $characterSync = new WikiSyncService();
  $characterSync->sync();
 }

 public function characterScraping(): void {
  $characterScraping = new WikiScrapingService();
  $characterScraping->scraping();
 }

 //De testeo
 public function singleCharacter(): void {
  $singleCharacterScraping = new WikiScrapingService();
  $singleCharacterScraping->singleCharacter("https://kof.fandom.com/es/wiki/Zero_(NESTS)");
 }

 //De testeo
 public function remainingCharacters(): void {
  $characterSync = new WikiSyncService();
  $characterSync->characterFourthPart();
 }
}