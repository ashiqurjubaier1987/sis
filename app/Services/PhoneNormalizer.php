<?php

namespace App\Services;

class PhoneNormalizer
{
    /**
     * Normalize a Bangladeshi phone number to 8801XXXXXXXXX
     */
    public static function normalize(string $number): string
    {
        $cleaned = preg_replace('/[^\d]/', '', $number);

        // 01XXXXXXXXX → add 88 prefix
        if (strlen($cleaned) === 11 && preg_match('/^01[3-9]/', $cleaned)) {
            return '88' . $cleaned;
        }

        // 8801XXXXXXXXX → keep as-is
        if (preg_match('/^8801[3-9]\d{8}$/', $cleaned)) {
            return $cleaned;
        }

        // Fallback: return cleaned (may fail validation)
        return $cleaned;
    }
}
