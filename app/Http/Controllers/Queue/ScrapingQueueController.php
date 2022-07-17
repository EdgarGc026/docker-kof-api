<?php

namespace App\Http\Controllers\Queue;

use App\Http\Controllers\Controller;
use App\Jobs\ScrapingCharacterJob;
use App\Jobs\SyncCharacterJob;

class ScrapingQueueController extends Controller {
 public function Buttonsync() {
  SyncCharacterJob::dispatch();
  // return back()->with('success', 'Personajes actualizados correctamente');
 }

 public function ButtonScrapping() {
  ScrapingCharacterJob::dispatch();
  // return back()->with('success', 'Personajes actualizados correctamente');
 }
}
