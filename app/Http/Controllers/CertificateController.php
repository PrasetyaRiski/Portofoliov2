<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CertificateController extends Controller
{
    public function index(Request $request): View
    {
        $query = Certificate::published()->ordered();

        // Filter by category
        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        // Filter by issuer
        if ($request->filled('issuer')) {
            $query->byIssuer($request->issuer);
        }

        // Filter by validity
        if ($request->filled('validity')) {
            match($request->validity) {
                'valid' => $query->valid(),
                'expired' => $query->expired(),
                default => null,
            };
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('issuer', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $certificates = $query->paginate(12);
        
        $categories = config('portfolio.certificates.categories');
        
        // Get unique issuers
        $issuers = Certificate::distinct()
            ->pluck('issuer')
            ->sort()
            ->values();

        return view('public.certificates.index', compact(
            'certificates',
            'categories',
            'issuers'
        ));
    }

    public function show(Certificate $certificate): View
    {
        return view('public.certificates.show', compact('certificate'));
    }
}
