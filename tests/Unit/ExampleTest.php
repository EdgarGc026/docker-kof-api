<?php

namespace Tests\Unit;

use App\Jobs\SyncCharacterJob;
use Illuminate\Support\Facades\Queue;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase {
 /**
  * A basic test example.
  *
  * @return void
  */
 public function test_that_dispatch_a_fake_queue() {
  Queue::fake();

  Queue::assertPushed(SyncCharacterJob::class, function ($job) {
   return true;
  });
 }
}
