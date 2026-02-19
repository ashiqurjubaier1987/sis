<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class BangladeshPhoneNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Remove all non-digit characters except +
        $cleaned = preg_replace('/[^\d+]/', '', $value);

        // Validate formats:
        // 1. 01[3-9]XXXXXXXX (11 digits, e.g., 017..., 019...)
        // 2. 8801[3-9]XXXXXXXX (13 digits)
        // 3. +8801[3-9]XXXXXXXX (14 digits with +)
        $isValid = preg_match('/^01[3-9]\d{8}$/', $cleaned) ||       // 017..., 019..., etc. (11 digits)
                  preg_match('/^8801[3-9]\d{8}$/', $cleaned) ||      // 88017..., 88019..., etc. (13 digits)
                  preg_match('/^\+8801[3-9]\d{8}$/', $cleaned);      // +88017..., +88019..., etc. (14 digits)

        if (!$isValid) {
            $fail('The :attribute must be a valid Bangladeshi mobile number (e.g., 013XXXXXXX, 019XXXXXXX, +88018XXXXXXX, or 88016XXXXXXX).');
        }
    }
    
}
