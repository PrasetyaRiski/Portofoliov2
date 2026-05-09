<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

if (!function_exists('get_avatar')) {
    /**
     * Get the current avatar URL
     * 
     * @return string
     */
    function get_avatar(): string
    {
        $settingsFile = storage_path('app/settings.json');
        
        if (file_exists($settingsFile)) {
            $settings = json_decode(file_get_contents($settingsFile), true);
            $path = $settings['avatar'] ?? null;
            
            if ($path) {
                // Check both storage disk and physical public folder (for cPanel)
                $storageExists = Storage::disk('public')->exists($path);
                $publicPath = public_path('storage/' . $path);
                $publicExists = File::exists($publicPath);
                
                if ($storageExists || $publicExists) {
                    return asset('storage/' . $path);
                }
            }
        }
        
        // Return default avatar
        return asset('images/avatar.jpg');
    }
}

if (!function_exists('storage_url')) {
    /**
     * Get the URL for a file in public storage
     * Works for both symlinked and copied storage setups (cPanel)
     * 
     * @param string|null $path
     * @param string|null $default
     * @return string|null
     */
    function storage_url(?string $path, ?string $default = null): ?string
    {
        if (!$path) {
            return $default;
        }
        
        // Check if file exists in storage or public folder
        $storageExists = Storage::disk('public')->exists($path);
        $publicPath = public_path('storage/' . $path);
        $publicExists = File::exists($publicPath);
        
        if ($storageExists || $publicExists) {
            return asset('storage/' . $path);
        }
        
        return $default;
    }
}
