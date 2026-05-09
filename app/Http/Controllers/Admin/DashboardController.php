<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Certificate;
use App\Models\Skill;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'projects' => [
                'total' => Project::count(),
                'published' => Project::published()->count(),
                'draft' => Project::where('status', 'draft')->count(),
                'views' => Project::sum('views_count'),
            ],
            'certificates' => [
                'total' => Certificate::count(),
                'verified' => Certificate::verified()->count(),
                'expiring' => Certificate::where('expiry_date', '<=', now()->addMonths(3))
                    ->where('expiry_date', '>', now())
                    ->count(),
            ],
            'skills' => [
                'total' => Skill::count(),
                'featured' => Skill::featured()->count(),
            ],
            'contacts' => [
                'total' => Contact::count(),
                'unread' => Contact::unread()->count(),
            ],
        ];

        $recentProjects = Project::latest()->take(5)->get();
        $recentContacts = Contact::recent()->take(5)->get();
        $topProjects = Project::published()->orderBy('views_count', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentProjects', 'recentContacts', 'topProjects'));
    }
}
