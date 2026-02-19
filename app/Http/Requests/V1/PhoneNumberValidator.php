<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\BangladeshPhoneNumber;

class PhoneNumberValidator extends FormRequest
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
            'phone' => [new BangladeshPhoneNumber],
        ];
    }

    // Normalize to 8801[3-9]XXXXXXXX format
    public function prepareForValidation()
    {
        if ($this->phone) {
            $this->merge([
                'phone' => $this->normalizePhone($this->phone),
            ]);
        }
    }

    protected function normalizePhone($number)
    {
        $cleaned = preg_replace('/[^\d]/', '', $number);

        // Case 1: 01[3-9]XXXXXXXX (11 digits) → Add 88 prefix
        if (strlen($cleaned) === 11 && preg_match('/^01[3-9]/', $cleaned)) {
            return '88' . $cleaned;
        }

        // Case 2: 8801[3-9]XXXXXXXX or +8801[3-9]XXXXXXXX → Keep digits only
        if (preg_match('/^\+?8801[3-9]/', $cleaned)) {
            return str_replace('+', '', $cleaned);
        }

        return $cleaned; // Fallback (will fail validation if invalid)
    }
}
