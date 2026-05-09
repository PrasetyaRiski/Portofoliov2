<?php

namespace App\Providers;

use App\Services\StorageSyncService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Force HTTPS in production (common cPanel setup)
        if (config('app.env') === 'production' || env('FORCE_HTTPS', false)) {
            URL::forceScheme('https');
        }
        
        // Ensure public storage directory exists for cPanel compatibility
        // This handles cases where symlink doesn't work
        try {
            if (StorageSyncService::needsSync()) {
                $syncService = new StorageSyncService();
                $syncService->ensurePublicStorageExists();
            }
        } catch (\Exception $e) {
            // Silently fail - don't break the app if storage check fails
        }
    }
}
