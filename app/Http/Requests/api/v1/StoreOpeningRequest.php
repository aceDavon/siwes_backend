<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;

class StoreOpeningRequest extends FormRequest
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
            "title" => ['required', "min:15"],
            "organization" => "required",
            "field" => ["required", "min:5"],
            "is_open" => "required",
            "user_id" => ["required", "exists:users,id"]
        ];
    }
}
