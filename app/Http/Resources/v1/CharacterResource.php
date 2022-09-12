<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class CharacterResource extends JsonResource {
 /**
  * Transform the resource into an array.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
  */
 public function toArray($request) {
  return [
   'id' => $this->id ?? null,
   'name' => $this->name ?? null,
   'url' => $this->url ?? null,
   'fullname' => $this->fullname ?? null,
   'birthday' => $this->birthday ?? null,
   'weight' => $this->weight ?? null,
   'height' => $this->height ?? null,
   'bloodType' => $this->bloodType ?? null,
   'relatives' => $this->relatives ?? null,
   'occupation' => $this->occupation ?? null,
   'likes' => $this->likes ?? null,
   'hates' => $this->hates ?? null,
   'hobbies' => $this->hobbies ?? null,
   'favoriteFood' => $this->favoriteFood ?? null,
   'sportSkill' => $this->sportSkill ?? null,
   'specialSkill' => $this->specialSkill ?? null,
   'favoriteMusic' => $this->favoriteMusic ?? null,
   'measures' => $this->measures ?? null,
   'guns' => $this->guns ?? null,
   'fightStyle' => $this->fightStyle ?? null,
  ];
 }
}
