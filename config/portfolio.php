<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Portfolio Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration settings for the portfolio website
    |
    */

    'owner' => [
        'name' => env('OWNER_NAME', "Prasetya Riski Wa'afan"),
        'email' => env('OWNER_EMAIL', 'pr0165341@gmail.com'),
        'title' => env('OWNER_TITLE', 'Web Developer & Content Creator'),
        'university' => env('OWNER_UNIVERSITY', 'Universitas Muhammadiyah Ponorogo'),
        'location' => env('OWNER_LOCATION', 'Slahung, Ponorogo, Jawa Timur'),
        'phone' => env('OWNER_PHONE', '+62 858-5388-0228'),
        'birthdate' => env('OWNER_BIRTHDATE', '2004-09-29'),
        'bio' => 'Mahasiswa Universitas Muhammadiyah Ponorogo dengan pengalaman dalam mendesain dan mengembangkan situs web yang fungsional dan menarik. Berkomitmen menciptakan solusi digital yang sesuai kebutuhan pengguna melalui desain inovatif dan responsif. Selain web development, saya juga memiliki keahlian di bidang photography, videography, dan video editing.',
        'avatar' => 'images/avatar.jpg',
        'resume' => 'documents/resume.pdf',
    ],

    'social' => [
        'github' => env('GITHUB_URL'),
        'linkedin' => env('LINKEDIN_URL'),
        'twitter' => env('TWITTER_URL'),
        'instagram' => env('INSTAGRAM_URL'),
    ],

    'seo' => [
        'title' => "Prasetya Riski Wa'afan - Web Developer & UI/UX Designer",
        'description' => 'Portfolio Prasetya Riski Wa\'afan - Mahasiswa Universitas Muhammadiyah Ponorogo. Web Developer & UI/UX Designer dengan keahlian dalam mendesain dan mengembangkan situs web yang fungsional, menarik, dan responsif.',
        'keywords' => 'Prasetya Riski, portfolio, web developer, UI/UX designer, Ponorogo, Universitas Muhammadiyah Ponorogo, Laravel, PHP, photography, videography',
        'author' => env('OWNER_NAME', "Prasetya Riski Wa'afan"),
    ],

    'projects' => [
        'categories' => [
            'web' => 'Web Development',
            'mobile' => 'Mobile App',
            'desktop' => 'Desktop Application',
            'api' => 'API Development',
            'ai' => 'AI/Machine Learning',
            'iot' => 'Internet of Things',
            'video' => 'Videography',
            'photo' => 'Photography',
            'design' => 'Graphic Design',
            'other' => 'Other',
        ],
        'statuses' => [
            'draft' => 'Draft',
            'published' => 'Published',
            'archived' => 'Archived',
        ],
    ],

    'certificates' => [
        'categories' => [
            'programming' => 'Programming',
            'cloud' => 'Cloud Computing',
            'security' => 'Cybersecurity',
            'database' => 'Database',
            'network' => 'Networking',
            'soft-skill' => 'Soft Skills',
            'other' => 'Other',
        ],
    ],

    'skills' => [
        'categories' => [
            'frontend' => 'Frontend Development',
            'backend' => 'Backend Development',
            'mobile' => 'Mobile Development',
            'database' => 'Database',
            'devops' => 'DevOps & Cloud',
            'tools' => 'Tools & Software',
            'soft-skill' => 'Soft Skills',
        ],
        'levels' => [
            'beginner' => [1, 25],
            'intermediate' => [26, 50],
            'advanced' => [51, 75],
            'expert' => [76, 100],
        ],
    ],

    'upload' => [
        'images' => [
            'max_size' => 5120, // KB
            'allowed_types' => ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'],
            'dimensions' => [
                'thumbnail' => [150, 150],
                'medium' => [400, 400],
                'large' => [800, 800],
            ],
        ],
        'documents' => [
            'max_size' => 10240, // KB
            'allowed_types' => ['pdf', 'doc', 'docx'],
        ],
    ],
];
