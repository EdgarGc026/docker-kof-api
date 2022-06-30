<?php

namespace App\Services\Character;

class CharacterService {
 public function characterSync(): void {
  $characterSync = new CharacterSyncService();
  $characterSync->sync();
 }

 public function characterScraping() {
  $characterScraping = new CharacterSyncService();
  $characterScraping->scraping();
 }

 public function singleCharacter() {
  $singleCharacterScraping = new characterScraping();
  $singleCharacterScraping->singleCharacter('https://kof.fandom.com/es/wiki/Zero_(clon)');
 }

}