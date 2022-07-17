<?php

namespace App\Jobs;

use App\Models\Character;
use App\Services\Character\CharacterScrapingService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ScrapingCharacterJob implements ShouldQueue {
 use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

 /**
  * The character instance.
  * @var \App\Models\Character
  */
 public $character;

 /**
  * Create a new job instance.
  *@param App\Models\Character $character
  * @return void
  */
 public function __construct(Character $character) {
  $this->character = $character;
 }

 /**
  * Execute the job.
  *@param App\Services\Character\CharacterScrapingService $service
  * @return void
  */
 public function handle(CharacterScrapingService $characterScrapingService) {
  $characterScrapingService->scraping();
 }
}
