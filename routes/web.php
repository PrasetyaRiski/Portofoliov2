<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\CertificateController as AdminCertificateController;
use App\Http\Controllers\Admin\SkillController as AdminSkillController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\SettingsController as AdminSettingsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

/*
|--------------------------------------------------------------------------
| Debug Route - HAPUS SETELAH SELESAI DEBUG
|--------------------------------------------------------------------------
*/
Route::get('/debug-storage', function () {
    $storagePath = storage_path('app/public');
    $publicPath = public_path('storage');
    
    // Get detected public_html path
    $syncService = new \App\Services\StorageSyncService();
    $publicHtmlPath = $syncService->getPublicHtmlPath();
    
    $info = [
        'APP_URL' => config('app.url'),
        'base_path' => base_path(),
        'public_path_function' => public_path(),
        'storage_path' => $storagePath,
        'public_storage_path' => $publicPath,
        'detected_public_html_storage' => $publicHtmlPath,
        'env_PUBLIC_HTML_PATH' => env('PUBLIC_HTML_PATH', 'not set'),
        'storage_exists' => File::isDirectory($storagePath),
        'public_storage_exists' => File::isDirectory($publicPath),
        'public_html_storage_exists' => $publicHtmlPath ? (File::isDirectory($publicHtmlPath) ? 'yes' : 'no (will be created)') : 'N/A',
        'storage_files' => [],
        'public_files' => [],
        'public_html_files' => [],
    ];
    
    // List files in storage
    if (File::isDirectory($storagePath)) {
        foreach (File::allFiles($storagePath) as $file) {
            $info['storage_files'][] = $file->getRelativePathname();
        }
    }
    
    // List files in public/storage
    if (File::isDirectory($publicPath)) {
        foreach (File::allFiles($publicPath) as $file) {
            $info['public_files'][] = $file->getRelativePathname();
        }
    }
    
    // List files in public_html/storage
    if ($publicHtmlPath && File::isDirectory($publicHtmlPath)) {
        foreach (File::allFiles($publicHtmlPath) as $file) {
            $info['public_html_files'][] = $file->getRelativePathname();
        }
    }
    
    return response()->json($info, 200, [], JSON_PRETTY_PRINT);
});

// Force sync route for testing - HAPUS SETELAH SELESAI DEBUG
Route::get('/debug-sync-now', function () {
    $syncService = new \App\Services\StorageSyncService();
    $count = $syncService->syncAll();
    
    return response()->json([
        'status' => 'success',
        'files_synced' => $count,
        'public_html_path' => $syncService->getPublicHtmlPath(),
        'message' => "Synced {$count} files. Now check /debug-storage to verify."
    ]);
});

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Projects
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

// Certificates
Route::get('/certificates', [CertificateController::class, 'index'])->name('certificates.index');
Route::get('/certificates/{certificate}', [CertificateController::class, 'show'])->name('certificates.show');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Projects CRUD
    Route::resource('projects', AdminProjectController::class);
    Route::post('projects/{id}/restore', [AdminProjectController::class, 'restore'])->name('projects.restore');
    Route::delete('projects/{id}/force-delete', [AdminProjectController::class, 'forceDelete'])->name('projects.forceDelete');
    Route::post('projects/{project}/toggle-featured', [AdminProjectController::class, 'toggleFeatured'])->name('projects.toggleFeatured');
    Route::patch('projects/{project}/status', [AdminProjectController::class, 'updateStatus'])->name('projects.updateStatus');

    // Certificates CRUD
    Route::resource('certificates', AdminCertificateController::class);
    Route::post('certificates/{id}/restore', [AdminCertificateController::class, 'restore'])->name('certificates.restore');
    Route::delete('certificates/{id}/force-delete', [AdminCertificateController::class, 'forceDelete'])->name('certificates.forceDelete');
    Route::post('certificates/{certificate}/toggle-featured', [AdminCertificateController::class, 'toggleFeatured'])->name('certificates.toggleFeatured');
    Route::post('certificates/{certificate}/toggle-verified', [AdminCertificateController::class, 'toggleVerified'])->name('certificates.toggleVerified');

    // Skills CRUD
    Route::resource('skills', AdminSkillController::class)->except(['show']);
    Route::post('skills/{skill}/toggle-featured', [AdminSkillController::class, 'toggleFeatured'])->name('skills.toggleFeatured');
    Route::post('skills/update-order', [AdminSkillController::class, 'updateOrder'])->name('skills.updateOrder');

    // Contacts Management
    Route::get('contacts', [AdminContactController::class, 'index'])->name('contacts.index');
    Route::get('contacts/{contact}', [AdminContactController::class, 'show'])->name('contacts.show');
    Route::post('contacts/{contact}/mark-read', [AdminContactController::class, 'markAsRead'])->name('contacts.mark-read');
    Route::post('contacts/{contact}/mark-replied', [AdminContactController::class, 'markAsReplied'])->name('contacts.mark-replied');
    Route::post('contacts/{contact}/archive', [AdminContactController::class, 'archive'])->name('contacts.archive');
    Route::patch('contacts/{contact}/notes', [AdminContactController::class, 'updateNotes'])->name('contacts.updateNotes');
    Route::delete('contacts/{contact}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');
    Route::post('contacts/bulk-action', [AdminContactController::class, 'bulkAction'])->name('contacts.bulkAction');
    Route::post('contacts/mark-all-read', [AdminContactController::class, 'markAllAsRead'])->name('contacts.mark-all-read');

    // Settings
    Route::get('settings', [AdminSettingsController::class, 'index'])->name('settings.index');
    Route::put('settings/avatar', [AdminSettingsController::class, 'updateAvatar'])->name('settings.avatar.update');
    Route::delete('settings/avatar', [AdminSettingsController::class, 'removeAvatar'])->name('settings.avatar.remove');
    
    // Storage Sync (for cPanel hosting where symlinks don't work)
    Route::post('storage-sync', [AdminSettingsController::class, 'syncStorage'])->name('settings.storage-sync');
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);
});

Route::post('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
