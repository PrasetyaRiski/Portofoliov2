<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SkillApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Skill::ordered();

        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        if ($request->filled('featured')) {
            $query->featured();
        }

        $skills = $query->get();

        // Group by category if requested
        if ($request->boolean('grouped')) {
            $skills = $skills->groupBy('category');
        }

        return response()->json([
            'success' => true,
            'data' => $skills,
        ]);
    }
}
