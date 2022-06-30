<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model {
 use HasFactory;

 protected $guarded = [];

 protected $fillable = [
  'id', 'name', 'url', 'fullname', 'birthday', 'weight',
  'height', 'bloodType', 'relatives', 'occupation', 'likes',
  'hates', 'hobbies', 'favoriteFood', 'sportSkill', 'specialSkill',
  'favoriteMusic', 'measures', 'guns', 'fightStyle', 'avatar',
 ];

 public function characterProfile() {
  return $this->hasOne(Character::class);
 }
}
