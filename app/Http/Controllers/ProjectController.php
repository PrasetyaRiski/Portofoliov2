<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(Request $request): View
    {
        $query = Project::published()->ordered();

        // Filter by category
        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        // Filter by technology
        if ($request->filled('tech')) {
            $query->whereJsonContains('technologies', $request->tech);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        $projects = $query->paginate(12);
        
        $categories = config('portfolio.projects.categories');
        
        // Get all unique technologies
        $technologies = Project::published()
            ->whereNotNull('technologies')
            ->get()
            ->pluck('technologies')
            ->flatten()
            ->unique()
            ->sort()
            ->values();

        return view('public.projects.index', compact(
            'projects',
            'categories',
            'technologies'
        ));
    }

    public function show(Project $project): View
    {
        // Only show published projects
        if ($project->status !== 'published') {
            abort(404);
        }

        // Increment views
        $project->incrementViews();

        // Get related projects (same category)
        $relatedProjects = Project::published()
            ->byCategory($project->category)
            ->where('id', '!=', $project->id)
            ->ordered()
            ->take(3)
            ->get();

        return view('public.projects.show', compact('project', 'relatedProjects'));
    }
}
