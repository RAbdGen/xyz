<?php

namespace Tests;

use App\Models\Week;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected Week $currentWeek;

    public function setUp(): void
    {
        parent::setUp();

        $this->currentWeek = Week::factory()->current()->create();
    }
}
