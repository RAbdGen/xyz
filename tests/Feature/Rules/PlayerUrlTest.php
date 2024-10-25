<?php

namespace Tests\Feature\Rules;

use Tests\TestCase;
use App\Rules\PlayerUrl;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlayerUrlTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test unsupported URLs.
     */
    public function test_unsupported_url(): void
    {
        $rule = new PlayerUrl;

        $rule->validate("url", "https://example.com", fn ($message) => $this->assertIsString($message));
        $rule->validate("url", "https://open.spotify.com/intl-fr/track/73sgNPaEDEdqLJ8mLvto1a?si=d3b26a3e1cf74291", fn ($message) => $this->assertIsString($message));
    }

    /**
     * Test Soundcloud URLs.
     */
    public function test_soundcloud_url(): void
    {
        $rule = new PlayerUrl;

        $rule->validate("url", "https://soundcloud.com/artist/name", fn ($message) => $this->assertEmpty($message));
        $rule->validate("url", "https://soundcloud.com/artist/sets/name", fn ($message) => $this->assertIsString($message));
    }

    /**
     * Test YouTube URLs.
     */
    public function test_youtube_url(): void
    {
        $rule = new PlayerUrl;

        $rule->validate("url", "https://youtube.com/watch?v=hYfz5adLxJc", fn ($message) => $this->assertEmpty($message));
        $rule->validate("url", "https://youtube.com/random/watch?v=hYfz5adLxJc", fn ($message) => $this->assertIsString($message));
        $rule->validate("url", "https://youtu.be/hYfz5adLxJc", fn ($message) => $this->assertEmpty($message));
    }
}
