<?php

namespace App\Rules;

use Closure;
use App\Players\Player;
use Illuminate\Contracts\Validation\ValidationRule;

class PlayerUrl implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! app(Player::class)->validate($value)) {
            $fail(trans('validation.unsupported_player'));
        }
    }
}
