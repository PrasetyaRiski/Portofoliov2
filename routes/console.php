<?php

use App\Services\StorageSyncService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/**
 * Sync storage files to public folder
 * Useful for cPanel hosting where symlinks don't work
 */
Artisan::command('storage:sync', function () {
    $this->info('Syncing storage files to public folder...');
    
    $syncService = new StorageSyncService();
    $count = $syncService->syncAll();
    
    $this->info("Successfully synced {$count} files.");
})->purpose('Sync storage/app/public to public/storage for cPanel hosting');
