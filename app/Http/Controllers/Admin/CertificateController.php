<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Http\Requests\Admin\CertificateRequest;
use App\Services\FileUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CertificateController extends Controller
{
    public function __construct(
        protected FileUploadService $fileUploadService
    ) {}

    public function index(Request $request): View
    {
        $query = Certificate::query();

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by issuer
        if ($request->filled('issuer')) {
            $query->where('issuer', $request->issuer);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('issuer', 'like', "%{$search}%");
            });
        }

        $certificates = $query->latest()->paginate(15);
        $categories = config('portfolio.certificates.categories');
        $issuers = Certificate::distinct()->pluck('issuer');

        return view('admin.certificates.index', compact('certificates', 'categories', 'issuers'));
    }

    public function create(): View
    {
        $categories = config('portfolio.certificates.categories');

        return view('admin.certificates.create', compact('categories'));
    }

    public function store(CertificateRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $data['logo_path'] = $this->fileUploadService->upload(
                $request->file('logo'),
                'certificates/logos'
            );
        }

        // Handle certificate image upload
        if ($request->hasFile('certificate_image')) {
            $data['certificate_image'] = $this->fileUploadService->upload(
                $request->file('certificate_image'),
                'certificates/images'
            );
        }

        // Convert skills_covered string to array
        if (isset($data['skills_covered']) && is_string($data['skills_covered'])) {
            $data['skills_covered'] = array_map('trim', explode(',', $data['skills_covered']));
        }

        Certificate::create($data);

        return redirect()
            ->route('admin.certificates.index')
            ->with('success', 'Certificate created successfully!');
    }

    public function edit(Certificate $certificate): View
    {
        $categories = config('portfolio.certificates.categories');

        return view('admin.certificates.edit', compact('certificate', 'categories'));
    }

    public function update(CertificateRequest $request, Certificate $certificate): RedirectResponse
    {
        $data = $request->validated();

        // Handle logo upload
        if ($request->hasFile('logo')) {
            if ($certificate->logo_path) {
                $this->fileUploadService->delete($certificate->logo_path);
            }
            $data['logo_path'] = $this->fileUploadService->upload(
                $request->file('logo'),
                'certificates/logos'
            );
        }

        // Handle certificate image upload
        if ($request->hasFile('certificate_image')) {
            if ($certificate->certificate_image) {
                $this->fileUploadService->delete($certificate->certificate_image);
            }
            $data['certificate_image'] = $this->fileUploadService->upload(
                $request->file('certificate_image'),
                'certificates/images'
            );
        }

        // Convert skills_covered string to array
        if (isset($data['skills_covered']) && is_string($data['skills_covered'])) {
            $data['skills_covered'] = array_map('trim', explode(',', $data['skills_covered']));
        }

        $certificate->update($data);

        return redirect()
            ->route('admin.certificates.index')
            ->with('success', 'Certificate updated successfully!');
    }

    public function destroy(Certificate $certificate): RedirectResponse
    {
        $certificate->delete();

        return redirect()
            ->route('admin.certificates.index')
            ->with('success', 'Certificate moved to trash!');
    }

    public function restore(int $id): RedirectResponse
    {
        $certificate = Certificate::withTrashed()->findOrFail($id);
        $certificate->restore();

        return redirect()
            ->route('admin.certificates.index')
            ->with('success', 'Certificate restored successfully!');
    }

    public function forceDelete(int $id): RedirectResponse
    {
        $certificate = Certificate::withTrashed()->findOrFail($id);
        
        if ($certificate->logo_path) {
            $this->fileUploadService->delete($certificate->logo_path);
        }
        
        if ($certificate->certificate_image) {
            $this->fileUploadService->delete($certificate->certificate_image);
        }
        
        $certificate->forceDelete();

        return redirect()
            ->route('admin.certificates.index')
            ->with('success', 'Certificate permanently deleted!');
    }

    public function toggleFeatured(Certificate $certificate): RedirectResponse
    {
        $certificate->update(['is_featured' => !$certificate->is_featured]);

        return redirect()
            ->back()
            ->with('success', 'Certificate featured status updated!');
    }

    public function toggleVerified(Certificate $certificate): RedirectResponse
    {
        $certificate->update(['is_verified' => !$certificate->is_verified]);

        return redirect()
            ->back()
            ->with('success', 'Certificate verification status updated!');
    }
}
