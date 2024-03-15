<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['string', 'max:255', 'nullable'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'phone' => ['string', 'digits_between:10,15'],
            'photo' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }
}
