<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Skill;
use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Default Admin User
        User::updateOrCreate(
            ['email' => 'muhamirn6@gmail.com'],
            [
                'name' => 'Muhammad Amir Nurudin',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Seed Skills
        $skillsData = [
            // Frontend Development (lebih suka - ~90%)
            [
                'name' => 'Responsive Web Design',
                'category' => 'Frontend Development',
                'level' => 95,
                'icon' => 'fa-solid fa-mobile-screen-button',
                'description' => 'Membangun antarmuka yang adaptif untuk berbagai ukuran layar menggunakan CSS modern.',
            ],
            [
                'name' => 'JavaScript (DOM Manipulation)',
                'category' => 'Frontend Development',
                'level' => 90,
                'icon' => 'fa-brands fa-js',
                'description' => 'Membuat elemen web interaktif dan reaktif dengan JavaScript murni maupun library.',
            ],
            [
                'name' => 'UI/UX Implementation',
                'category' => 'Frontend Development',
                'level' => 88,
                'icon' => 'fa-solid fa-palette',
                'description' => 'Menerjemahkan desain visual menjadi kode frontend yang presisi dan fungsional.',
            ],

            // Backend Development (setengahnya - ~50%)
            [
                'name' => 'Laravel (Basic & Intermediate)',
                'category' => 'Backend Development',
                'level' => 55,
                'icon' => 'fa-brands fa-laravel',
                'description' => 'Mengelola routing, controller, dan integrasi database melalui Eloquent ORM.',
            ],
            [
                'name' => 'Database Management (MySQL)',
                'category' => 'Backend Development',
                'level' => 50,
                'icon' => 'fa-solid fa-database',
                'description' => 'Merancang struktur tabel sederhana dan melakukan operasi CRUD data.',
            ],

            // Tools & Others
            [
                'name' => 'Git & GitHub',
                'category' => 'Tools',
                'level' => 85,
                'icon' => 'fa-brands fa-github',
                'description' => 'Manajemen versi kode dan kolaborasi proyek melalui platform GitHub.',
            ],
        ];

        foreach ($skillsData as $skill) {
            Skill::updateOrCreate(
                ['name' => $skill['name']],
                $skill
            );
        }

        // 3. Seed Projects
        $projectsData = [
            [
                'title' => 'Personal Portfolio Website',
                'description' => 'Website portofolio interaktif yang dibangun dengan Laravel dan Vanilla CSS. Fokus pada estetika visual dan pengalaman pengguna yang halus.',
                'tech_stack' => ['Laravel', 'CSS3', 'JavaScript'],
                'image_path' => 'images/projects/portfolio.png',
                'project_url' => '#',
                'github_url' => 'https://github.com/muhamirudin/portfolio',
                'featured' => true,
                'contribution_percentage' => 100,
            ],
            [
                'title' => 'E-Library Management System',
                'description' => 'Sistem manajemen perpustakaan digital dengan fitur peminjaman buku dan manajemen inventaris.',
                'tech_stack' => ['PHP', 'MySQL', 'Bootstrap'],
                'image_path' => 'images/projects/ecommerce.png',
                'project_url' => null,
                'github_url' => 'https://github.com/muhamirudin/elibrary',
                'featured' => false,
                'contribution_percentage' => 80,
            ],
            [
                'title' => 'Simple Task Manager API',
                'description' => 'Pengembangan API sederhana untuk manajemen tugas harian, mengimplementasikan basic CRUD logic.',
                'tech_stack' => ['Laravel', 'REST API'],
                'image_path' => 'images/projects/logistics.png',
                'project_url' => null,
                'github_url' => 'https://github.com/muhamirudin/task-api',
                'featured' => true,
                'contribution_percentage' => 75,
            ],
        ];

        foreach ($projectsData as $project) {
            $slug = Str::slug($project['title']) . '-' . rand(1000, 9999);
            Project::updateOrCreate(
                ['title' => $project['title']],
                array_merge($project, ['slug' => $slug])
            );
        }
    }
}
