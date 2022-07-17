<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Character;

class HomeController extends Controller {
 public function index() {
  $pageName = "Personajes disponibles";
  $characters = Character::paginate(8);
  return view('home.index', ['pageName' => $pageName, 'characters' => $characters])->with('success', 'Personajes disponibles');
 }

/*  public function dashboard() {
return view('home.dashboard');
} */
}
