<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Project::published()->ordered();

        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        if ($request->filled('featured')) {
            $query->featured();
        }

        if ($request->filled('tech')) {
            $query->whereJsonContains('technologies', $request->tech);
        }

        $perPage = min($request->get('per_page', 15), 50);
        $projects = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $projects->items(),
            'meta' => [
                'current_page' => $projects->currentPage(),
                'last_page' => $projects->lastPage(),
                'per_page' => $projects->perPage(),
                'total' => $projects->total(),
            ],
        ]);
    }

    public function show(Project $project): JsonResponse
    {
        if ($project->status !== 'published') {
            return response()->json([
                'success' => false,
                'message' => 'Project not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $project,
        ]);
    }
}
