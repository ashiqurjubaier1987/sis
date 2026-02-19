<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use App\Support\Settings;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (!app()->runningInConsole() && Schema::hasTable('system_settings')) {
            view()->share(
                'settings',
                Cache::rememberForever('system_settings', function () {
                    return \App\Models\SystemSetting::pluck('value', 'key')->toArray();
                })
            );
        }

        // Register a custom macro for API responses
        // This macro can be used to standardize API responses across the application
        Response::macro('api', function ($data = null, $message = 'Success', $status = 200, $success = true, $errors = null) {
            return response()->json([
                'success' => $success,
                'message' => $message,
                'data' => $data,
                'errors' => $errors,
            ], $status);
        });
    }
}
