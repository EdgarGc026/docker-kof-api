<?php
namespace App\Http\Controllers\Scraping\WikiGame;

use App\Http\Controllers\Controller;
use App\Services\WikiGames\GameService;

class GameScrapingController extends Controller {
 public function gameSync(GameService $gameService): void {
  $gameService->sync();
 }

 public function gameScraping(GameService $gameService): void {
  $gameService->scraping();
 }

 //De testeo
 public function singleCharacter(GameService $gameService): void {
  $gameService->single();
 }
}