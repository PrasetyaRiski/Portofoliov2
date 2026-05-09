<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class StorageSyncService
{
    protected string $storagePath;
    protected string $publicPath;
    protected ?string $publicHtmlPath;

    public function __construct()
    {
        $this->storagePath = storage_path('app/public');
        $this->publicPath = public_path('storage');
        
        // For cPanel: get public_html path from env or auto-detect
        $this->publicHtmlPath = $this->getPublicHtmlStoragePath();
    }
    
    /**
     * Get public_html storage path for cPanel hosting
     */
    protected function getPublicHtmlStoragePath(): ?string
    {
        // First check if manually configured in .env
        $configuredPath = env('PUBLIC_HTML_PATH');
        if ($configuredPath) {
            return rtrim($configuredPath, '/') . '/storage';
        }
        
        // Auto-detect for cPanel structure
        $basePath = base_path();
        
        // Pattern: /home/username/something -> public_html is /home/username/public_html
        if (preg_match('#^(/home/[^/]+)/#', $basePath, $matches)) {
            $homeDir = $matches[1];
            $publicHtmlStorage = $homeDir . '/public_html/storage';
            $publicHtmlBase = $homeDir . '/public_html';
            
            // Check if public_html exists and is different from current public path
            if (is_dir($publicHtmlBase)) {
                $realPublicHtml = realpath($publicHtmlBase);
                $realPublic = realpath(public_path());
                
                // If they're different, we need to sync to public_html too
                if ($realPublicHtml !== $realPublic) {
                    return $publicHtmlStorage;
                }
            }
        }
        
        return null;
    }
    
    /**
     * Get the detected public_html path (for debugging)
     */
    public function getPublicHtmlPath(): ?string
    {
        return $this->publicHtmlPath;
    }

    /**
     * Sync a single file from storage to public
     */
    public function syncFile(string $relativePath): bool
    {
        // Normalize path separators for cross-platform compatibility
        $relativePath = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $relativePath);
        
        $sourcePath = $this->storagePath . DIRECTORY_SEPARATOR . $relativePath;
        $destPath = $this->publicPath . DIRECTORY_SEPARATOR . $relativePath;

        if (!File::exists($sourcePath)) {
            Log::warning("StorageSync: Source file not found: {$sourcePath}");
            return false;
        }

        try {
            // Create destination directory if not exists
            $destDir = dirname($destPath);
            if (!File::isDirectory($destDir)) {
                File::makeDirectory($destDir, 0755, true, true);
            }

            // Copy file with error handling
            $result = File::copy($sourcePath, $destPath);
            
            // Set proper permissions for web access
            if ($result && File::exists($destPath)) {
                @chmod($destPath, 0644);
            }
            
            // Also sync to public_html if on cPanel
            if ($this->publicHtmlPath) {
                $this->syncToPublicHtml($relativePath);
            }
            
            return $result;
        } catch (\Exception $e) {
            Log::error("StorageSync: Failed to sync file {$relativePath}: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Sync file to public_html (for cPanel hosting)
     */
    protected function syncToPublicHtml(string $relativePath): bool
    {
        if (!$this->publicHtmlPath) {
            return false;
        }
        
        $sourcePath = $this->storagePath . DIRECTORY_SEPARATOR . $relativePath;
        $destPath = $this->publicHtmlPath . DIRECTORY_SEPARATOR . $relativePath;
        
        try {
            $destDir = dirname($destPath);
            if (!File::isDirectory($destDir)) {
                File::makeDirectory($destDir, 0755, true, true);
            }
            
            $result = File::copy($sourcePath, $destPath);
            if ($result && File::exists($destPath)) {
                @chmod($destPath, 0644);
            }
            return $result;
        } catch (\Exception $e) {
            Log::warning("StorageSync: Failed to sync to public_html: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Sync entire storage/app/public to public/storage
     */
    public function syncAll(): int
    {
        try {
            if (!File::isDirectory($this->publicPath)) {
                File::makeDirectory($this->publicPath, 0755, true, true);
            }

            $count = $this->copyDirectory($this->storagePath, $this->publicPath);
            
            // Also sync to public_html if on cPanel
            if ($this->publicHtmlPath) {
                if (!File::isDirectory($this->publicHtmlPath)) {
                    File::makeDirectory($this->publicHtmlPath, 0755, true, true);
                }
                $this->copyDirectory($this->storagePath, $this->publicHtmlPath);
            }
            
            return $count;
        } catch (\Exception $e) {
            Log::error("StorageSync: Failed to sync all: " . $e->getMessage());
            return 0;
        }
    }

    /**
     * Delete a file from both storage and public
     */
    public function deleteFile(string $relativePath): bool
    {
        // Normalize path separators
        $relativePath = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $relativePath);
        
        $storagePath = $this->storagePath . DIRECTORY_SEPARATOR . $relativePath;
        $publicPath = $this->publicPath . DIRECTORY_SEPARATOR . $relativePath;

        $deleted = false;

        try {
            if (File::exists($storagePath)) {
                File::delete($storagePath);
                $deleted = true;
            }

            if (File::exists($publicPath)) {
                File::delete($publicPath);
                $deleted = true;
            }
        } catch (\Exception $e) {
            Log::error("StorageSync: Failed to delete file {$relativePath}: " . $e->getMessage());
        }

        return $deleted;
    }

    /**
     * Copy directory recursively
     */
    protected function copyDirectory(string $source, string $destination): int
    {
        $count = 0;

        if (!File::isDirectory($source)) {
            return $count;
        }

        if (!File::isDirectory($destination)) {
            File::makeDirectory($destination, 0755, true, true);
        }

        $files = File::allFiles($source);

        foreach ($files as $file) {
            $relativePath = $file->getRelativePathname();
            // Normalize path separators
            $relativePath = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $relativePath);
            $destPath = $destination . DIRECTORY_SEPARATOR . $relativePath;
            $destDir = dirname($destPath);

            if (!File::isDirectory($destDir)) {
                File::makeDirectory($destDir, 0755, true, true);
            }

            if (File::copy($file->getPathname(), $destPath)) {
                @chmod($destPath, 0644);
                $count++;
            }
        }

        return $count;
    }

    /**
     * Check if sync is needed (symlink not working)
     */
    public static function needsSync(): bool
    {
        try {
            $linkPath = public_path('storage');
            
            // If it's a working symlink, no need to sync
            if (is_link($linkPath) && is_dir($linkPath)) {
                return false;
            }

            return true;
        } catch (\Exception $e) {
            // If any error, assume sync is needed
            return true;
        }
    }
    
    /**
     * Ensure public storage directory exists
     * Call this method on application boot for cPanel compatibility
     */
    public function ensurePublicStorageExists(): void
    {
        if (!File::isDirectory($this->publicPath)) {
            try {
                File::makeDirectory($this->publicPath, 0755, true, true);
            } catch (\Exception $e) {
                Log::error("StorageSync: Failed to create public storage directory: " . $e->getMessage());
            }
        }
    }
}
