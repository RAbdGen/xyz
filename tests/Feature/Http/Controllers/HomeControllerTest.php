<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Ensure user is redirected to login form.
     */
    public function test_redirect_if_unauthenticated(): void
    {
        $this->get(route('app.home'))->assertRedirectToRoute('login');
    }

    /**
     * Ensure user can show home page.
     */
    public function test_homepage(): void
    {
        /** @var User */
        $user = User::factory()->createOne();

        $this->actingAs($user)->get(route('app.home'))
            ->assertSuccessful();
    }
}
