<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CertificateApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Certificate::ordered();

        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        if ($request->filled('issuer')) {
            $query->byIssuer($request->issuer);
        }

        if ($request->filled('featured')) {
            $query->featured();
        }

        $perPage = min($request->get('per_page', 15), 50);
        $certificates = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $certificates->items(),
            'meta' => [
                'current_page' => $certificates->currentPage(),
                'last_page' => $certificates->lastPage(),
                'per_page' => $certificates->perPage(),
                'total' => $certificates->total(),
            ],
        ]);
    }

    public function show(Certificate $certificate): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $certificate,
        ]);
    }
}
