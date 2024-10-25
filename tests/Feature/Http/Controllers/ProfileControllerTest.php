<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    /** A fake user. */
    protected User $user;

    /** @inheritDoc */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->createOne();
    }

    /**
     * Ensure user is redirected to login form.
     */
    public function test_redirect_if_unauthenticated(): void
    {
        $this->get(route('app.profile.edit'))->assertRedirectToRoute('login');
    }

    /**
     * Ensure user can show profile edit form.
     */
    public function test_edit_form(): void
    {
        $this->actingAs($this->user)
            ->get(route('app.profile.edit'))
            ->assertSuccessful();
    }

    /**
     * Ensure user can update its profile.
     */
    public function test_update(): void
    {
        Storage::fake('public');

        $this->actingAs($this->user)->post(route('app.profile.update'), [
                'avatar' => UploadedFile::fake()->image('photo1.png'),
                'password' => 'new-password',
                'email' => 'new-email@example.com'
            ])
            ->assertRedirectToRoute('app.profile.edit');

        Storage::disk('public')->assertExists($this->user->fresh()->avatar);

        $this->assertDatabaseHas(User::class, [
            'id' => $this->user->id, 
            'email' => 'new-email@example.com'
        ]);
    }
}
