<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            // Programming Languages & Web
            [
                'name' => 'HTML',
                'slug' => 'html',
                'category' => 'frontend',
                'level' => 90,
                'icon' => 'fab fa-html5',
                'color' => '#E34F26',
                'description' => 'Membuat struktur halaman web dengan semantic HTML5.',
                'years_experience' => 3,
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'name' => 'CSS',
                'slug' => 'css',
                'category' => 'frontend',
                'level' => 88,
                'icon' => 'fab fa-css3-alt',
                'color' => '#1572B6',
                'description' => 'Styling dan layouting halaman web yang responsif dan menarik.',
                'years_experience' => 3,
                'is_featured' => true,
                'order' => 2,
            ],
            [
                'name' => 'JavaScript',
                'slug' => 'javascript',
                'category' => 'frontend',
                'level' => 80,
                'icon' => 'fab fa-js',
                'color' => '#F7DF1E',
                'description' => 'Membuat interaksi dinamis dan fungsionalitas pada website.',
                'years_experience' => 2,
                'is_featured' => true,
                'order' => 3,
            ],
            [
                'name' => 'PHP',
                'slug' => 'php',
                'category' => 'backend',
                'level' => 85,
                'icon' => 'fab fa-php',
                'color' => '#777BB4',
                'description' => 'Pengembangan backend dan server-side scripting.',
                'years_experience' => 2,
                'is_featured' => true,
                'order' => 4,
            ],
            [
                'name' => 'Laravel',
                'slug' => 'laravel',
                'category' => 'framework',
                'level' => 82,
                'icon' => 'fab fa-laravel',
                'color' => '#FF2D20',
                'description' => 'Framework PHP modern untuk pengembangan aplikasi web yang elegan dan powerful.',
                'years_experience' => 1,
                'is_featured' => true,
                'order' => 5,
            ],

            // Frameworks
            [
                'name' => 'Tailwind CSS',
                'slug' => 'tailwind-css',
                'category' => 'framework',
                'level' => 88,
                'icon' => 'fas fa-wind',
                'color' => '#06B6D4',
                'description' => 'Utility-first CSS framework untuk pengembangan UI yang cepat dan konsisten.',
                'years_experience' => 2,
                'is_featured' => true,
                'order' => 6,
            ],
            [
                'name' => 'Bootstrap',
                'slug' => 'bootstrap',
                'category' => 'framework',
                'level' => 85,
                'icon' => 'fab fa-bootstrap',
                'color' => '#7952B3',
                'description' => 'CSS framework populer untuk responsive web design.',
                'years_experience' => 2,
                'is_featured' => true,
                'order' => 7,
            ],

            // Tools
            [
                'name' => 'VS Code',
                'slug' => 'vs-code',
                'category' => 'tools',
                'level' => 92,
                'icon' => 'fas fa-code',
                'color' => '#007ACC',
                'description' => 'Code editor utama untuk pengembangan web dan aplikasi.',
                'years_experience' => 3,
                'is_featured' => true,
                'order' => 8,
            ],
            [
                'name' => 'GitHub',
                'slug' => 'github',
                'category' => 'tools',
                'level' => 80,
                'icon' => 'fab fa-github',
                'color' => '#181717',
                'description' => 'Version control dan kolaborasi kode dengan Git.',
                'years_experience' => 2,
                'is_featured' => true,
                'order' => 9,
            ],
            [
                'name' => 'Figma',
                'slug' => 'figma',
                'category' => 'tools',
                'level' => 78,
                'icon' => 'fab fa-figma',
                'color' => '#F24E1E',
                'description' => 'UI/UX design dan prototyping untuk web dan mobile.',
                'years_experience' => 1,
                'is_featured' => true,
                'order' => 10,
            ],
            [
                'name' => 'Premiere Pro',
                'slug' => 'premiere-pro',
                'category' => 'tools',
                'level' => 85,
                'icon' => 'fas fa-film',
                'color' => '#9999FF',
                'description' => 'Software editing video profesional dari Adobe Creative Suite.',
                'years_experience' => 2,
                'is_featured' => true,
                'order' => 11,
            ],
            [
                'name' => 'Canva',
                'slug' => 'canva',
                'category' => 'tools',
                'level' => 88,
                'icon' => 'fas fa-palette',
                'color' => '#00C4CC',
                'description' => 'Platform desain grafis untuk membuat konten visual yang menarik.',
                'years_experience' => 2,
                'is_featured' => true,
                'order' => 12,
            ],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }
}
