<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use App\Services\StorageSyncService;

class FileUploadService
{
    protected string $disk = 'public';
    protected StorageSyncService $syncService;

    public function __construct()
    {
        $this->syncService = new StorageSyncService();
    }

    /**
     * Upload a file to storage
     */
    public function upload(UploadedFile $file, string $directory = 'uploads', ?array $options = []): string
    {
        $filename = $this->generateFilename($file);
        $path = "{$directory}/{$filename}";

        // Check if it's an image and should be processed
        if ($this->isImage($file) && !($options['skip_processing'] ?? false)) {
            return $this->uploadImage($file, $directory, $options);
        }

        // Regular file upload
        Storage::disk($this->disk)->putFileAs($directory, $file, $filename);

        // Auto sync to public folder
        $this->syncService->syncFile($path);

        return $path;
    }

    /**
     * Upload and process an image
     */
    public function uploadImage(UploadedFile $file, string $directory = 'uploads', ?array $options = []): string
    {
        $filename = $this->generateFilename($file);
        $path = "{$directory}/{$filename}";

        // Read the image
        $image = Image::read($file);

        // Resize if max dimensions are specified
        $maxWidth = $options['max_width'] ?? 1920;
        $maxHeight = $options['max_height'] ?? 1080;

        if ($image->width() > $maxWidth || $image->height() > $maxHeight) {
            $image->scaleDown($maxWidth, $maxHeight);
        }

        // Set quality
        $quality = $options['quality'] ?? 85;

        // Get the encoded image
        $encoded = $image->toJpeg($quality);

        // If original format should be preserved
        if ($options['preserve_format'] ?? false) {
            $extension = strtolower($file->getClientOriginalExtension());
            $encoded = match($extension) {
                'png' => $image->toPng(),
                'gif' => $image->toGif(),
                'webp' => $image->toWebp($quality),
                default => $image->toJpeg($quality),
            };
        }

        // Store the image
        Storage::disk($this->disk)->put($path, $encoded);

        // Auto sync to public folder
        $this->syncService->syncFile($path);

        // Create thumbnail if requested
        if ($options['create_thumbnail'] ?? false) {
            $this->createThumbnail($file, $directory, $filename, $options);
        }

        return $path;
    }

    /**
     * Create a thumbnail version of an image
     */
    protected function createThumbnail(UploadedFile $file, string $directory, string $filename, array $options = []): string
    {
        $thumbWidth = $options['thumb_width'] ?? 300;
        $thumbHeight = $options['thumb_height'] ?? 300;

        $image = Image::read($file);
        $image->cover($thumbWidth, $thumbHeight);

        $thumbFilename = 'thumb_' . $filename;
        $thumbPath = "{$directory}/thumbnails/{$thumbFilename}";

        Storage::disk($this->disk)->put($thumbPath, $image->toJpeg(80));

        // Auto sync thumbnail
        $this->syncService->syncFile($thumbPath);

        return $thumbPath;
    }

    /**
     * Delete a file from storage
     */
    public function delete(?string $path): bool
    {
        if (!$path) {
            return false;
        }

        // Delete from both storage and public
        $this->syncService->deleteFile($path);

        if (Storage::disk($this->disk)->exists($path)) {
            return Storage::disk($this->disk)->delete($path);
        }

        return false;
    }

    /**
     * Delete multiple files
     */
    public function deleteMany(array $paths): void
    {
        foreach ($paths as $path) {
            $this->delete($path);
        }
    }

    /**
     * Generate a unique filename
     */
    protected function generateFilename(UploadedFile $file): string
    {
        $extension = $file->getClientOriginalExtension();
        $name = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $timestamp = now()->format('YmdHis');
        $random = Str::random(8);

        return "{$name}-{$timestamp}-{$random}.{$extension}";
    }

    /**
     * Check if file is an image
     */
    protected function isImage(UploadedFile $file): bool
    {
        return str_starts_with($file->getMimeType(), 'image/');
    }

    /**
     * Get the full URL for a stored file
     */
    public function url(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        return Storage::disk($this->disk)->url($path);
    }

    /**
     * Check if a file exists
     */
    public function exists(string $path): bool
    {
        return Storage::disk($this->disk)->exists($path);
    }

    /**
     * Get file size in bytes
     */
    public function size(string $path): int
    {
        return Storage::disk($this->disk)->size($path);
    }

    /**
     * Set the storage disk
     */
    public function disk(string $disk): self
    {
        $this->disk = $disk;
        return $this;
    }
}
