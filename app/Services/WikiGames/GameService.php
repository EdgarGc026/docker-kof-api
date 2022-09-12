<?php
namespace App\Services\WikiGames;

use Ifaces\InterfaceScrapingProcess;

class GameService implements InterfaceScrapingProcess {

 public function sync(): void {
  $gameSync = new GameSyncService();
  $gameSync->sync();
 }

 public function scraping(): void {
  $gameScraping = new GameScrapingService();
  $gameScraping->scraping();
 }

 public function single(): void {
  $singleGameScraping = new GameScrapingService();
  $singleGameScraping->singleGame('hola');
 }
}