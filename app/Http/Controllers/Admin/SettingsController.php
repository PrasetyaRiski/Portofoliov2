<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\StorageSyncService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SettingsController extends Controller
{
    protected StorageSyncService $syncService;

    public function __construct()
    {
        $this->syncService = new StorageSyncService();
    }

    public function index(): View
    {
        $currentAvatar = $this->getCurrentAvatar();
        
        // Check if storage sync is needed (for cPanel hosting)
        try {
            $needsSync = StorageSyncService::needsSync();
        } catch (\Exception $e) {
            $needsSync = true; // Default to showing sync option if error
        }
        
        return view('admin.settings.index', compact('currentAvatar', 'needsSync'));
    }
    
    /**
     * Sync all storage files to public folder
     * Useful for cPanel hosting where symlinks don't work
     */
    public function syncStorage(): RedirectResponse
    {
        $count = $this->syncService->syncAll();
        
        return redirect()
            ->route('admin.settings.index')
            ->with('success', "Storage synced successfully! {$count} files copied.");
    }

    public function updateAvatar(Request $request): RedirectResponse
    {
        $request->validate([
            'avatar' => ['required', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:5120'],
        ], [
            'avatar.required' => 'Please select an image file.',
            'avatar.image' => 'The file must be an image.',
            'avatar.mimes' => 'The image must be a JPG, PNG, GIF, or WebP file.',
            'avatar.max' => 'The image must be less than 5MB.',
        ]);

        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists (not the default)
            $oldAvatar = $this->getCurrentAvatarPath();
            if ($oldAvatar && Storage::disk('public')->exists($oldAvatar)) {
                Storage::disk('public')->delete($oldAvatar);
                // Also delete from public folder
                $this->syncService->deleteFile($oldAvatar);
            }

            // Store new avatar
            $path = $request->file('avatar')->store('images', 'public');
            
            // Auto sync to public folder
            $this->syncService->syncFile($path);
            
            // Save the path to a settings file or database
            $this->saveAvatarPath($path);

            return redirect()
                ->route('admin.settings.index')
                ->with('success', 'Avatar updated successfully!');
        }

        return redirect()
            ->route('admin.settings.index')
            ->with('error', 'Failed to upload avatar.');
    }

    public function removeAvatar(): RedirectResponse
    {
        $currentAvatar = $this->getCurrentAvatarPath();
        
        if ($currentAvatar && Storage::disk('public')->exists($currentAvatar)) {
            Storage::disk('public')->delete($currentAvatar);
            // Also delete from public folder
            $this->syncService->deleteFile($currentAvatar);
        }
        
        $this->saveAvatarPath(null);

        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Avatar removed successfully!');
    }

    private function getCurrentAvatar(): ?string
    {
        $path = $this->getCurrentAvatarPath();
        
        if ($path && Storage::disk('public')->exists($path)) {
            return asset('storage/' . $path);
        }
        
        // Return default avatar
        return asset('images/avatar.jpg');
    }

    private function getCurrentAvatarPath(): ?string
    {
        $settingsFile = storage_path('app/settings.json');
        
        if (file_exists($settingsFile)) {
            $settings = json_decode(file_get_contents($settingsFile), true);
            return $settings['avatar'] ?? null;
        }
        
        return null;
    }

    private function saveAvatarPath(?string $path): void
    {
        $settingsFile = storage_path('app/settings.json');
        $settings = [];
        
        if (file_exists($settingsFile)) {
            $settings = json_decode(file_get_contents($settingsFile), true) ?? [];
        }
        
        $settings['avatar'] = $path;
        
        file_put_contents($settingsFile, json_encode($settings, JSON_PRETTY_PRINT));
    }
}
