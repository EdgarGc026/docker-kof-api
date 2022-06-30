<?php

namespace App\Service\Character;

use App\Models\Character;
use Goutte\Client;

class CharacterScrapingService {

 public function scraping() {
  $this->getCharactersProfile();
 }

 //Obtenemos todos los monos en general
 private function getCharactersProfile(): void {
  $client = new Client();
  $characters = Character::all();
  $this->executeCharacterScraping($characters, $client);
 }

 //Obtenemos un simple monito
 public function singleCharacter($url): void {
  $characters = Character::where('url', $url)->first();
  $client = new Client();
  $crawler = $client->request('GET', $url);

  $arrayCharacter = $this->buildCharacter($avatarImage, $profileTitleResult, $profileDataResult);
  $this->saveCharacter($characters, $arrayCharacter);
 }

 //TODO: Por verificar
 private function buildCharacter($avatarImage, $profileTitleResult, $profileDataResult): array{
  $avatarImage = $this->getCharacterImage($crawler);
  $profileTitleResult = $this->getLeftDataProfile($crawler);
  $profileDataResult = $this->getRightDataProfile($crawler);
  $arrayCharacter = $this->mergeData($profileTitleResult, $profileDataResult, $avatarImage);
  return $arrayCharacter;
 }

 private function executeCharacterScraping($characters, $client): void {
  foreach ($characters as $character) {
   $crawler = $client->request('GET' . $character->url);
   $arrayCharacter = $this->buildCharacter($avatarImage, $profileTitleResult, $profileDataResult);
   $this->saveCharacter($character, $arrayCharacter);
  }
 }

 private function saveCharacter($character, $arrayCharacter) {
  $updateCharacter = $character->update([
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

 private function getCharacterImage($crawler): string | null {
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

 private function getLeftDataProfile($crawler): array{
  $data = [];
  $elementTd = $crawler->filter('table.darktable tbody tr')->filter('td');
  foreach ($elementTd as $key => $td) {
   if ($key % 2 != 0) {
    $data[$key] = $td->nodeValue;
   }
  }
  return $data;
 }

 private function getRightDataProfile($crawler): array{
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
  array_shift($rightArrayData);
  $combineArray = array_combine($leftArrayData, $rightArrayData);
  $arrFinal = array_merge($combineArray, $arrayImage);
  return $arrFinal;
 }

 public function utils() {
  echo "<pre>";
  print_r($var);
  echo "</pre>";
 }
}