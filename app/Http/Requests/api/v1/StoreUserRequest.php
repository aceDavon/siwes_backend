<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "email" => ['required', 'email'],
            "matric_no" => ['required', 'min:5'],
            "name" => ['required', 'max:50', 'min:5'],
            "user_role" => ['required', Rule::in(['student', 'lecturer', 'supervisor'])]
        ];
    }
}
