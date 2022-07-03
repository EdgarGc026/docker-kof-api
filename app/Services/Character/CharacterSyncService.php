<?php
namespace App\Services\Character;

use App\Models\Character;
use Goutte\Client;
use Illuminate\Http\JsonResponse;

class CharacterSyncService {

/* private static $remainingCharactersArray = [
"https://kof.fandom.com/es/wiki/Zero_(NESTS)",
"https://kof.fandom.com/es/wiki/Zero_(clon)",
];*/

 public function sync(): void {
  $this->initCharacter();
 }

 private function initCharacter(): JsonResponse {
  try {
   $url = 'https://kof.fandom.com/es/wiki/Personajes';
   $characterData = $this->characterInformation($url);
   $this->saveCharacter($characterData);
   $this->urlCharacters();
   return response()->json(['message' => 'Character Sync Successfuly'], 201);
  } catch (\Exception$e) {
   return response()->json(['message' => 'Character Sync Successfuly'], 500);
  }
 }

 public function remainCharacter() {
  print_r("Hola");
 }

 private function characterInformation($url): array{
  $client = new Client();
  $crawler = $client->request('GET', $url);
  $characterFirstPart = $this->characterFirstPart($crawler);
  $characterSecondPart = $this->characterSecondPart($crawler);
  $characterArray = array_merge($characterFirstPart, $characterSecondPart);
  return $characterArray;
 }

 private function saveCharacter($characterData): void {
  foreach ($characterData as $character) {
   if (!Character::where('name', $character)->first()) {
    Character::create(['name' => $character]);
   }
  }
 }

 private function urlCharacters(): void {
  $characters = Character::all();
  foreach ($characters as $character) {
   $url = 'https://kof.fandom.com/es/wiki/' . $character->name;
   $result = !$character->url ? Character::where('id', $character->id)->update(['url' => $url]) : null;
  }
 }

 private function characterFirstPart($crawler): array{
  $elementTd = $crawler->filter('table tbody tr')->children('td');
  $names = $elementTd->children('a')->extract(['href']);
  $arrayData = $this->characterProfile($names);
  return $arrayData;
 }

 private function characterSecondPart($crawler): array{
  $elementTd = $crawler->filter('table tbody tr')->children('td');
  $names = $elementTd->children('p > a')->extract(['href']);
  $arrayData = $this->characterProfile($names);
  return $arrayData;
 }

 private function characterProfile($names): array{
  $arrayNames = [];
  foreach ($names as $name) {
   $name = str_replace('/es/wiki/', '', $name);
   $arrayNames[] = $name;
  }
  return $arrayNames;
 }

}