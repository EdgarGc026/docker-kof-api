<?php
namespace App\Services\WikiCharacter;

use App\Models\Character;
use Exception;
use Goutte\Client;

class WikiSyncService {
 public function sync(): void {
  $this->initCharacter();
 }

 private function initCharacter() {
  try {
   $url = 'https://kof.fandom.com/es/wiki/Personajes';
   $characterData = $this->characterInformation($url);
   $this->saveCharacter($characterData);
   $this->urlCharacters();
   return back()->with('success', 'Personajes actualizados correctamente');
  } catch (\Exception$e) {
   return back()->with('error', 'Error al actualizar los personajes' . $e->getMessage());
  }
 }

 private function characterInformation($url): array{
  $client = new Client();
  try {
   $crawler = $client->request('GET', $url);
   $characterFirstPart = $this->characterFirstPart($crawler);
   $characterSecondPart = $this->characterSecondPart($crawler);
   $characterThirdPart = $this->characterThirdPart($crawler);
   $characterFourthPart = $this->characterFourthPart();
   $characterArray = array_merge($characterFirstPart, $characterSecondPart, $characterThirdPart, $characterFourthPart);
  } catch (Exception $e) {
   throw new Exception('Error al obtener la informacion de los personajes');
  }
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
  $arrayNames = $this->characterProfile($names);
  if (!$arrayNames) {
   throw new Exception('Error en la primera parte de la obtencion de los personajes');
  }
  return $arrayNames;
 }

 private function characterSecondPart($crawler): array{
  $elementTd = $crawler->filter('table tbody tr')->children('td');
  $names = $elementTd->children('p > a')->extract(['href']);
  $arrayNames = $this->characterProfile($names);
  if (!$arrayNames) {
   throw new Exception('Error en la segunda parte de la obtencion de los personajes');
  }
  return $arrayNames;
 }

 private function characterThirdPart($crawler) {
  $elementTd = $crawler->filter('table tbody tr')->children('td');
  $names = $elementTd->children('p > b > a')->extract(['href']);
  $arrayNames = $this->characterProfile($names);
  if (!$arrayNames) {
   throw new Exception('Error en la tercera parte de la obtencion de los personajes');
  }
  return $arrayNames;
 }

 public function characterFourthPart() {
  $remainingCharactersArray = [
   "/es/wiki/Zero_(NESTS)", "/es/wiki/Zero_(clon)",
  ];

  $arrayNames = $this->characterProfile($remainingCharactersArray);
  if (!$arrayNames) {
   throw new Exception('Error en la cuarta parte de la obtencion de los personajes');
  }
  return $arrayNames;
 }

 private function characterProfile($names): array{
  $arrayNames = [];
  foreach ($names as $name) {
   $name = str_replace('/es/wiki/', '', $name);
   $arrayNames[] = $name;
  }
  if (!$arrayNames) {
   throw new Exception('Error en el split del nombre del personaje');
  }
  return $arrayNames;
 }

}