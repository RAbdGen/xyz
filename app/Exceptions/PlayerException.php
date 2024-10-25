<?php

namespace App\Exceptions;

use RuntimeException;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PlayerException extends RuntimeException
{
    /**
     * PlayerException is thrown when something wrong
     * with embed code or thumbnail retrieving.
     */
    public function __construct(
        protected $message,
        protected array $context = []
    ) {
        parent::__construct($message);
    }

    /**
     * Get the exception's context information.
     *
     * @return array<string, mixed>
     */
    public function context(): array
    {
        return $this->context;
    }

    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request): RedirectResponse
    {
        return back()
            ->withErrors(['url' => trans('validation.unexpected_player_error')])
            ->withInput($request->only(['title', 'artist', 'url']));
    }
}
