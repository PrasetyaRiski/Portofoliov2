<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Http\Requests\Admin\SkillRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SkillController extends Controller
{
    public function index(Request $request): View
    {
        $query = Skill::query();

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $skills = $query->ordered()->paginate(20);
        $categories = config('portfolio.skills.categories');

        return view('admin.skills.index', compact('skills', 'categories'));
    }

    public function create(): View
    {
        $categories = config('portfolio.skills.categories');

        return view('admin.skills.create', compact('categories'));
    }

    public function store(SkillRequest $request): RedirectResponse
    {
        Skill::create($request->validated());

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Skill created successfully!');
    }

    public function edit(Skill $skill): View
    {
        $categories = config('portfolio.skills.categories');

        return view('admin.skills.edit', compact('skill', 'categories'));
    }

    public function update(SkillRequest $request, Skill $skill): RedirectResponse
    {
        $skill->update($request->validated());

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Skill updated successfully!');
    }

    public function destroy(Skill $skill): RedirectResponse
    {
        $skill->delete();

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Skill deleted successfully!');
    }

    public function toggleFeatured(Skill $skill): RedirectResponse
    {
        $skill->update(['is_featured' => !$skill->is_featured]);

        return redirect()
            ->back()
            ->with('success', 'Skill featured status updated!');
    }

    public function updateOrder(Request $request): RedirectResponse
    {
        $request->validate([
            'skills' => 'required|array',
            'skills.*.id' => 'required|exists:skills,id',
            'skills.*.order' => 'required|integer|min:0',
        ]);

        foreach ($request->skills as $skillData) {
            Skill::where('id', $skillData['id'])->update(['order' => $skillData['order']]);
        }

        return redirect()
            ->back()
            ->with('success', 'Skills order updated!');
    }
}
