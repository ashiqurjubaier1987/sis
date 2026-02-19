<?php
// app/Support/Settings.php
namespace App\Support;

use App\Models\SystemSetting;
use Illuminate\Support\Facades\Cache;


class Settings
{
    public static function get($key, $default = null)
    {
        $settings = Cache::rememberForever('system_settings', function () {
            return SystemSetting::pluck('value', 'key')->toArray();
        });

        return $settings[$key] ?? $default;
    }

    public static function clearCache()
    {
        Cache::forget('system_settings');
    }
}
