<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\Admin\ProjectRequest;
use App\Services\FileUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function __construct(
        protected FileUploadService $fileUploadService
    ) {}

    public function index(Request $request): View
    {
        $query = Project::withTrashed();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $projects = $query->latest()->paginate(15);
        $categories = config('portfolio.projects.categories');
        $statuses = config('portfolio.projects.statuses');

        return view('admin.projects.index', compact('projects', 'categories', 'statuses'));
    }

    public function create(): View
    {
        $categories = config('portfolio.projects.categories');
        $statuses = config('portfolio.projects.statuses');

        return view('admin.projects.create', compact('categories', 'statuses'));
    }

    public function store(ProjectRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $this->fileUploadService->upload(
                $request->file('featured_image'),
                'projects/featured'
            );
        }

        // Handle gallery images upload
        if ($request->hasFile('gallery_images')) {
            $galleryImages = [];
            foreach ($request->file('gallery_images') as $image) {
                $galleryImages[] = $this->fileUploadService->upload($image, 'projects/gallery');
            }
            $data['gallery_images'] = $galleryImages;
        }

        // Convert technologies string to array
        if (isset($data['technologies']) && is_string($data['technologies'])) {
            $data['technologies'] = array_map('trim', explode(',', $data['technologies']));
        }

        Project::create($data);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project created successfully!');
    }

    public function show(Project $project): View
    {
        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project): View
    {
        $categories = config('portfolio.projects.categories');
        $statuses = config('portfolio.projects.statuses');

        return view('admin.projects.edit', compact('project', 'categories', 'statuses'));
    }

    public function update(ProjectRequest $request, Project $project): RedirectResponse
    {
        $data = $request->validated();

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($project->featured_image) {
                $this->fileUploadService->delete($project->featured_image);
            }
            $data['featured_image'] = $this->fileUploadService->upload(
                $request->file('featured_image'),
                'projects/featured'
            );
        }

        // Handle gallery images
        if ($request->hasFile('gallery_images')) {
            $existingGallery = $project->gallery_images ?? [];
            foreach ($request->file('gallery_images') as $image) {
                $existingGallery[] = $this->fileUploadService->upload($image, 'projects/gallery');
            }
            $data['gallery_images'] = $existingGallery;
        }

        // Handle removed gallery images
        if ($request->filled('removed_gallery_images')) {
            $removedImages = $request->removed_gallery_images;
            $currentGallery = $data['gallery_images'] ?? $project->gallery_images ?? [];
            
            foreach ($removedImages as $image) {
                $this->fileUploadService->delete($image);
                $currentGallery = array_filter($currentGallery, fn($img) => $img !== $image);
            }
            
            $data['gallery_images'] = array_values($currentGallery);
        }

        // Convert technologies string to array
        if (isset($data['technologies']) && is_string($data['technologies'])) {
            $data['technologies'] = array_map('trim', explode(',', $data['technologies']));
        }

        $project->update($data);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project moved to trash!');
    }

    public function restore(int $id): RedirectResponse
    {
        $project = Project::withTrashed()->findOrFail($id);
        $project->restore();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project restored successfully!');
    }

    public function forceDelete(int $id): RedirectResponse
    {
        $project = Project::withTrashed()->findOrFail($id);
        
        // Delete all images
        if ($project->featured_image) {
            $this->fileUploadService->delete($project->featured_image);
        }
        
        if ($project->gallery_images) {
            foreach ($project->gallery_images as $image) {
                $this->fileUploadService->delete($image);
            }
        }
        
        $project->forceDelete();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project permanently deleted!');
    }

    public function toggleFeatured(Project $project): RedirectResponse
    {
        $project->update(['is_featured' => !$project->is_featured]);

        return redirect()
            ->back()
            ->with('success', 'Project featured status updated!');
    }

    public function updateStatus(Request $request, Project $project): RedirectResponse
    {
        $request->validate(['status' => 'required|in:draft,published,archived']);
        
        $project->update(['status' => $request->status]);

        return redirect()
            ->back()
            ->with('success', 'Project status updated!');
    }
}
