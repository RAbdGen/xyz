<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\User;
use App\Models\Track;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;

class TrackControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Track $track;

    public function setUp(): void
    {
        parent::setUp();

        // Create a fake user
        $this->user = User::factory()->createOne();

        // Create a fake track
        $this->track = Track::factory()
            ->for($this->currentWeek)
            ->sample()
            ->createOne();

        Http::fake([
            // Stub a JSON response for soundcloud.com/oembed endpoint
            'https://soundcloud.com/oembed*' => Http::response([
                "thumbnail_url" => "https://localhost/fake-artwork.jpg",
                "html" => "<iframe width=\"100%\" height=\"400\" scrolling=\"no\" frameborder=\"no\" src=\"https://w.soundcloud.com/player/?visual=true&url=https%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F123456789&show_artwork=true\"></iframe>"
            ], 200),
        ]);
    }

    /**
     * Ensure user is redirected to login form.
     */
    public function test_redirect_if_unauthenticated(): void
    {
        $this->get(route('app.home'))->assertRedirectToRoute('login');
    }

    /**
     * Ensure user can show a track.
     */
    public function test_track_show(): void
    {
        $this->actingAs($this->user)
            ->get(route('app.tracks.show', [
                'week' => $this->currentWeek->uri,
                'track' => $this->track->id
            ]))
            ->assertSuccessful();
    }

    /**
     * Ensure user can show create track form.
     */
    public function test_track_create_form(): void
    {
        $this->actingAs($this->user)
            ->get(route('app.tracks.create'))
            ->assertSuccessful();
    }

    /**
     * Ensure user can create a soundcloud track.
     */
    public function test_track_create_soundcloud(): void
    {
        $track = Track::factory()->sample()->make();

        $this->actingAs($this->user)
            ->post(route('app.tracks.store'), [
                'artist' => $track->artist
            ])
            ->assertRedirect()
            ->assertSessionHasErrors(['title', 'url']);

        $this->actingAs($this->user)
            ->followingRedirects()
            ->post(route('app.tracks.store'), [
                'title' => $track->title,
                'artist' => $track->artist,
                'url' => $track->url,
            ])
            ->assertSuccessful();

        $this->assertDatabaseHas(Track::class, [
            'title' => $track->title,
            'artist' => $track->artist,
            'player' => 'soundcloud',
            'player_track_id' => '123456789',
            'player_thumbnail_url' => 'https://localhost/fake-artwork.jpg'
        ]);
    }

    /**
     * Ensure user can create a youtube track.
     */
    public function test_track_create_youtube(): void
    {
        $track = Track::factory()->make([
            'url' => 'https://www.youtube.com/watch?v=hYfz5adLxJc'
        ]);

        $this->actingAs($this->user)
            ->followingRedirects()
            ->post(route('app.tracks.store'), [
                'title' => $track->title,
                'artist' => $track->artist,
                'url' => $track->url,
            ])
            ->assertSuccessful();

        $this->assertDatabaseHas(Track::class, [
            'title' => $track->title,
            'artist' => $track->artist,
            'player' => 'youtube',
            'player_track_id' => 'hYfz5adLxJc',
            'player_thumbnail_url' => 'https://img.youtube.com/vi/hYfz5adLxJc/hqdefault.jpg'
        ]);
    }

    /**
     * Ensure user can like a track.
     */
    public function test_track_like(): void
    {
        $params = [
            'week' => $this->currentWeek->uri,
            'track' => $this->track->id
        ];

        $this->actingAs($this->user)
            ->post(route('app.tracks.like', $params))
            ->assertRedirectToRoute('app.tracks.show', $params);
    }
}
