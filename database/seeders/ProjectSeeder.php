<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'E-Commerce Platform',
                'slug' => 'e-commerce-platform',
                'category' => 'web',
                'short_description' => 'A full-featured e-commerce platform with payment integration, inventory management, and analytics dashboard.',
                'description' => "A comprehensive e-commerce solution built with Laravel and Vue.js.\n\n## Features\n- User authentication & authorization\n- Product catalog with categories\n- Shopping cart & checkout\n- Payment gateway integration (Midtrans)\n- Order management system\n- Admin dashboard with analytics\n- Email notifications\n- Mobile responsive design\n\n## Technical Details\nThis project demonstrates my ability to build complex web applications with proper architecture, clean code, and modern best practices.",
                'technologies' => ['Laravel', 'Vue.js', 'MySQL', 'Tailwind CSS', 'Midtrans', 'Redis'],
                'demo_url' => 'https://demo-ecommerce.example.com',
                'github_url' => 'https://github.com/username/ecommerce',
                'client' => 'Personal Project',
                'start_date' => now()->subMonths(6),
                'end_date' => now()->subMonths(3),
                'status' => 'published',
                'is_featured' => true,
                'views_count' => 1250,
                'order' => 1,
            ],
            [
                'title' => 'Task Management App',
                'slug' => 'task-management-app',
                'category' => 'web',
                'short_description' => 'A collaborative task management application with real-time updates and team collaboration features.',
                'description' => "A modern task management application built for teams.\n\n## Features\n- Create, assign, and track tasks\n- Kanban board view\n- Team collaboration\n- Real-time notifications\n- File attachments\n- Due date reminders\n- Progress tracking\n\n## Technical Highlights\n- Real-time updates using WebSockets\n- RESTful API design\n- Clean architecture pattern",
                'technologies' => ['Laravel', 'React', 'PostgreSQL', 'Pusher', 'Docker'],
                'demo_url' => 'https://demo-taskapp.example.com',
                'github_url' => 'https://github.com/username/taskapp',
                'client' => 'Freelance Project',
                'start_date' => now()->subMonths(4),
                'end_date' => now()->subMonths(2),
                'status' => 'published',
                'is_featured' => true,
                'views_count' => 890,
                'order' => 2,
            ],
            [
                'title' => 'Hospital Management System',
                'slug' => 'hospital-management-system',
                'category' => 'web',
                'short_description' => 'Complete hospital information system with patient records, scheduling, and billing modules.',
                'description' => "An enterprise-grade hospital management system.\n\n## Modules\n- Patient Registration & Records\n- Doctor Scheduling\n- Appointment Booking\n- Pharmacy Management\n- Billing & Invoicing\n- Laboratory Results\n- Reports & Analytics\n\n## Security Features\n- Role-based access control\n- Audit logging\n- Data encryption\n- HIPAA compliance considerations",
                'technologies' => ['Laravel', 'Livewire', 'MySQL', 'Alpine.js', 'Chart.js'],
                'demo_url' => null,
                'github_url' => null,
                'client' => 'RS. Sejahtera',
                'start_date' => now()->subMonths(8),
                'end_date' => now()->subMonths(4),
                'status' => 'published',
                'is_featured' => true,
                'views_count' => 560,
                'order' => 3,
            ],
            [
                'title' => 'Weather Mobile App',
                'slug' => 'weather-mobile-app',
                'category' => 'mobile',
                'short_description' => 'A beautiful weather application with location-based forecasts and weather alerts.',
                'description' => "A cross-platform mobile weather application.\n\n## Features\n- Current weather conditions\n- 7-day forecast\n- Hourly predictions\n- Weather alerts\n- Multiple locations\n- Beautiful animations\n- Offline mode",
                'technologies' => ['Flutter', 'Dart', 'OpenWeatherAPI', 'SQLite'],
                'demo_url' => null,
                'github_url' => 'https://github.com/username/weather-app',
                'client' => 'Personal Project',
                'start_date' => now()->subMonths(3),
                'end_date' => now()->subMonth(),
                'status' => 'published',
                'is_featured' => false,
                'views_count' => 320,
                'order' => 4,
            ],
            [
                'title' => 'Portfolio Website',
                'slug' => 'portfolio-website',
                'category' => 'web',
                'short_description' => 'A modern portfolio website with dark mode, animations, and admin panel.',
                'description' => "This portfolio website you're currently viewing!\n\n## Features\n- Modern glassmorphism design\n- Dark/Light mode\n- Smooth animations\n- Admin CRUD panel\n- Contact form\n- SEO optimized\n- Mobile responsive",
                'technologies' => ['Laravel', 'Tailwind CSS', 'Alpine.js', 'MySQL'],
                'demo_url' => 'https://portfolio.example.com',
                'github_url' => 'https://github.com/username/portfolio',
                'client' => 'Personal Project',
                'start_date' => now()->subMonths(2),
                'end_date' => now(),
                'status' => 'published',
                'is_featured' => false,
                'views_count' => 150,
                'order' => 5,
            ],
            [
                'title' => 'API Gateway Service',
                'slug' => 'api-gateway-service',
                'category' => 'api',
                'short_description' => 'A microservices API gateway with rate limiting, authentication, and request routing.',
                'description' => "A scalable API gateway for microservices architecture.\n\n## Features\n- Request routing\n- Load balancing\n- Rate limiting\n- Authentication & Authorization\n- Request/Response transformation\n- Logging & Monitoring\n- Circuit breaker pattern",
                'technologies' => ['Node.js', 'Express', 'Redis', 'JWT', 'Docker', 'Kubernetes'],
                'demo_url' => null,
                'github_url' => 'https://github.com/username/api-gateway',
                'client' => 'Personal Project',
                'start_date' => now()->subMonths(5),
                'end_date' => now()->subMonths(3),
                'status' => 'published',
                'is_featured' => false,
                'views_count' => 420,
                'order' => 6,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
