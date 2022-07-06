<?php

namespace App\Services\Character;

use App\Models\Character;
use Goutte\Client;

class CharacterScrapingService {
 public function scraping() {
  $this->charactersProfile();
 }

 //Obtenemos todos los monos en general
 private function charactersProfile(): void {
  $client = new Client();
  $characters = Character::all();
  $this->executeCharacterScraping($characters, $client);
 }

 //Obtenemos un simple monito
 public function singleCharacter($url): void {
  $characters = Character::where('url', $url)->first();
  $client = new Client();
  $crawler = $client->request('GET', $url);

  $arrayCharacter = $this->buildCharacter($crawler);
  $this->saveCharacter($characters, $arrayCharacter);
 }

 private function executeCharacterScraping($characters, $client): void {
  foreach ($characters as $character) {
   $crawler = $client->request('GET', $character->url);
   $arrayCharacter = $this->buildCharacter($crawler);
   $this->saveCharacter($character, $arrayCharacter);
  }
 }

 //TODO: Por verificar
 private function buildCharacter($crawler): array{
  $profileTitleResult = $this->titleProfile($crawler);
  $profileDataResult = $this->dataProfile($crawler);
  $avatarImage = $this->characterImage($crawler);
  $arrayCharacter = $this->mergeData($profileTitleResult, $profileDataResult, $avatarImage);
  return $arrayCharacter;
 }

 private function saveCharacter($character, $arrayCharacter): void {
  $character->update([
   'fullname' => $arrayCharacter['Nombre Completo'] ?? null,
   'birthday' => $arrayCharacter['Fecha de Nacimiento'] ?? null,
   'weight' => $arrayCharacter['Altura'] ?? null,
   'height' => $arrayCharacter['Peso'] ?? null,
   'bloodType' => $arrayCharacter['Tipo Sanguineo'] ?? null,
   'relatives' => $arrayCharacter['Familiares/Relaciones'] ?? null,
   'occupation' => $arrayCharacter['Ocupación'] ?? null,
   'likes' => $arrayCharacter['Gustos'] ?? null,
   'hates' => $arrayCharacter['Odia'] ?? null,
   'hobbies' => $arrayCharacter['Hobbies'] ?? null,
   'favoriteFood' => $arrayCharacter['Comida Favorita'] ?? null,
   'sportSkill' => $arrayCharacter['Deportes que Domina'] ?? null,
   'specialSkill' => $arrayCharacter['Habilidad Especial'] ?? null,
   'favoriteMusic' => $arrayCharacter['Musica Favorita'] ?? null,
   'measures' => $arrayCharacter['Medidas'] ?? null,
   'guns' => $arrayCharacter['Armas'] ?? null,
   'fightStyle' => $arrayCharacter['Estilo de Pelea'] ?? null,
   'avatar' => $arrayCharacter['Avatar'] ?? null,
  ]);
 }

 private function characterImage($crawler): string | null {
  try {
   $image = $crawler->filter('table.darktable tbody tr td img')->attr('data-src');
   if (is_null($image)) {
    $image = $crawler->filter('table.darktable tbody tr td img')->attr('src');
   }

   return $image;
  } catch (\Exception$e) {
   echo "No se pudo obtener la imagen del monito";
   return null;
  }
 }

 private function titleProfile($crawler): array{
  $data = [];
  $elementTd = $crawler->filter('table.darktable tbody tr')->filter('td');
  foreach ($elementTd as $key => $td) {
   if ($key % 2 != 0) {
    $data[$key] = $td->nodeValue;
   }
  }
  return $data;
 }

 private function dataProfile($crawler): array{
  $data = [];
  $elementTd = $crawler->filter('table.darktable tbody tr')->filter('td');
  foreach ($elementTd as $key => $td) {
   if ($key % 2 == 0) {
    $data[$key] = $td->nodeValue;
   }
  }
  return $data;
 }

 private function mergeData($profileTitleResult, $profileDataResult, $avatarImage): array{
  $arrayImage = ['Avatar' => $avatarImage];
  array_shift($profileDataResult);
  $combineArray = array_combine($profileTitleResult, $profileDataResult);
  $arrFinal = array_merge($combineArray, $arrayImage);
  return $arrFinal;
 }
}
