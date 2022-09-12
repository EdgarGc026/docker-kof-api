<?php
namespace App\Services\WikiGames;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class GameSyncService {
 public function sync() {
  $this->initGame();
 }

 private function initGame() {
  try {
   $url = 'https://kof.fandom.com/es/wiki/The_King_of_Fighters';
   $gameData = $this->gameInformation($url);
  } catch (\Exception$e) {
   $e->getMessage();
  }
 }

 private function gameInformation($url): array{
  $client = new Client();
  $crawler = $client->request('GET', $url);
  $this->gameGeneralInformation($crawler);
  return $gameArray = [];
 }

 private function gameGeneralInformation($crawler): array{
  $elementTd = $crawler->filter('.mw-parser-output > table tr')->each(function (Crawler $crawler) {
   $this->foo($crawler);
  });
  return [];
 }

 private function foo($crawler) {
  $multipleOfThree = 3;
  $multipleOfTwo = 2;
  foreach ($crawler as $content => $value) {
   if ($this->multipleOf($content, $multipleOfThree)) {
    echo $content . "=>" . $value->tagName;
   }

   if ($this->multipleOf($content, $multipleOfTwo)) {
    echo $content . "=>" . $value->tagName;
   }
  }
 }

 private function multipleOf($multiple, $number) {
  $result = $multiple % $number;

 }
}
