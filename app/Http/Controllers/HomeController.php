<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Certificate;
use App\Models\Skill;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredProjects = Project::published()
            ->featured()
            ->ordered()
            ->take(6)
            ->get();

        $featuredCertificates = Certificate::featured()
            ->ordered()
            ->take(6)
            ->get();

        $featuredSkills = Skill::featured()
            ->ordered()
            ->get()
            ->groupBy('category');

        $allSkills = Skill::ordered()
            ->get()
            ->groupBy('category');

        return view('public.home', compact(
            'featuredProjects',
            'featuredCertificates',
            'featuredSkills',
            'allSkills'
        ));
    }

    public function about(): View
    {
        $skills = Skill::ordered()->get()->groupBy('category');
        
        return view('public.about', compact('skills'));
    }
}
