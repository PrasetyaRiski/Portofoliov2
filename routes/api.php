<?php

use App\Http\Controllers\Api\ProjectApiController;
use App\Http\Controllers\Api\CertificateApiController;
use App\Http\Controllers\Api\SkillApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public API endpoints
Route::prefix('v1')->group(function () {
    // Projects
    Route::get('/projects', [ProjectApiController::class, 'index']);
    Route::get('/projects/{project}', [ProjectApiController::class, 'show']);

    // Certificates
    Route::get('/certificates', [CertificateApiController::class, 'index']);
    Route::get('/certificates/{certificate}', [CertificateApiController::class, 'show']);

    // Skills
    Route::get('/skills', [SkillApiController::class, 'index']);
});

// Protected API endpoints (for future integrations)
Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    // Add protected endpoints here
});
