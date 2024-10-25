<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Ensure user is redirected to login form.
     */
    public function test_redirect_if_unauthenticated(): void
    {
        $this->get(route('app.home'))->assertRedirectToRoute('login');
        $this->get(route('app.profile.edit'))->assertRedirectToRoute('login');
        $this->get(route('app.weeks.index'))->assertRedirectToRoute('login');
    }

    /**
     * Ensure user can fill login form.
     */
    public function test_login_form(): void
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
    }

    /**
     * Ensure login with valid credentials is functional.
     */
    public function test_login(): void
    {
        $user = User::factory()->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirectToRoute('app.home');
    }

    /**
     * Ensure login with wrong credentials fails.
     */
    public function test_login_failure(): void
    {
        $response = $this->post(route('login'), [
            'email' => 'wrong-email@example.com',
            'password' => 'password'
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors(['email']);
    }

    /**
     * Ensure user can log out.
     */
    public function test_logout(): void
    {
        /** @var \App\Models\User */
        $user = User::factory()->createOne();

        $response = $this->actingAs($user)->post(route('logout'));

        $this->assertGuest();
        $response->assertRedirectToRoute('login');
    }
}
