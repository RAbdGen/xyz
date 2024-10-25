<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Code;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Ensure user is redirected to login form 
     * when signup code is invalid or missing.
     */
    public function test_redirect_if_code_invalid(): void
    {
        $code = Code::factory()->consumed()->createOne();

        // Missing code
        $this->get(route('signup.terms'))->assertRedirectToRoute('login')->assertSessionHasErrors(['code']);
        $this->get(route('signup.account'))->assertRedirectToRoute('login')->assertSessionHasErrors(['code']);
        $this->post(route('signup.account'))->assertRedirectToRoute('login')->assertSessionHasErrors(['code']);

        // Invalid code
        $this->get(route('signup.terms', ['code' => $code]))->assertRedirectToRoute('login')->assertSessionHasErrors(['code']);
        $this->get(route('signup.account', ['code' => $code]))->assertRedirectToRoute('login')->assertSessionHasErrors(['code']);
        $this->post(route('signup.account', ['code' => $code]))->assertRedirectToRoute('login')->assertSessionHasErrors(['code']);
    }

    /**
     * Ensure user can fill terms form.
     */
    public function test_terms_form(): void
    {
        $code = Code::factory()->createOne();

        $this->get(route('signup.terms', ['code' => $code->code]))
            ->assertSuccessful();

        $this->get(route('signup.account', ['code' => $code->code]))
            ->assertRedirectToRoute('signup.terms', ['code' => $code->code])
            ->assertSessionHasErrors('terms');

        $this->get(route('signup.account', ['code' => $code->code, 'terms' => true]))
            ->assertSuccessful();
    }

    /**
     * Ensure user can fill account form.
     */
    public function test_account_form(): void
    {
        $code = Code::factory()->createOne();

        $response = $this->post(route('signup.account', [
            'code' => $code->code,
            'email' => fake()->email(),
            'password' => 'password',
        ]));

        $this->assertAuthenticated();
        $response->assertRedirectToRoute('app.home');
    }
}
