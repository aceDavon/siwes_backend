<?php

namespace App\Rules\api\v1;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class MatricLoginRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Retrieve the user input for the matric number and password
        $input = request()->only(['matric_no', 'password']);

        // Check if the matric number exists in the database
        $user = User::where('matric_no', $input['matric_no'])->first();
        if (!$user) {
            $fail('Invalid matric number or password.');
        }

        // Validate the password
        if (!Hash::check($input['password'], $user->password)) {
            $fail('Invalid matric number or password.');
        }
    }
}
