<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\BangladeshPhoneNumber;
use App\Services\PhoneNormalizer;

class RegisterRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'phone' => ['required', new BangladeshPhoneNumber(), 'unique:users,phone'],
            'photo_id_number' => 'nullable|string|unique:users,photo_id_number|min:4',
            'password' => 'required|string|min:4|confirmed',
        ];

    }

    /**
     * Normalize phone before validation
     */
    protected function prepareForValidation()
    {
        if ($this->phone) {
            $this->merge([
                'phone' => PhoneNormalizer::normalize($this->phone),
            ]);
        }
    }
}
