<?php

namespace App\Http\Controllers\Api\v1;

use App\Filters\v1\CharacterFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\CharacterCollection;
use App\Http\Resources\v1\CharacterResource;
use App\Models\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller {
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function index(Request $request) {
  $filter = new CharacterFilter();
  $filterItems = $filter->transform($request); //[['column', 'operator', 'value']]

  if (count($filterItems) == 0) {
   return new CharacterCollection(Character::paginate());
  } else {
   $characters = Character::where($filterItems)->paginate();
   return new CharacterCollection($characters->appends($request->query()));
  }
 }

 /**
  * Display the specified resource.
  *
  * @param  Character $character
  * @return \Illuminate\Http\Response
  */
 public function show(Character $character) {
  return new CharacterResource($character);
 }
}
