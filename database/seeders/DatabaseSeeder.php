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
            // Frontend Development
            [
                'name' => 'Responsive Web Design',
                'category' => 'Frontend Development',
                'level' => 95,
                'icon' => 'fa-solid fa-mobile-screen-button',
                'description' => 'Membangun antarmuka yang adaptif untuk berbagai ukuran layar menggunakan CSS modern dan framework seperti Tailwind/Bootstrap.',
            ],
            [
                'name' => 'JavaScript (DOM & Node.js)',
                'category' => 'Frontend Development',
                'level' => 90,
                'icon' => 'fa-brands fa-js',
                'description' => 'Membuat elemen interaktif, manipulasi DOM murni, integrasi API, serta pengembangan Bot WhatsApp menggunakan Node.js.',
            ],
            [
                'name' => 'UI/UX Implementation',
                'category' => 'Frontend Development',
                'level' => 88,
                'icon' => 'fa-solid fa-palette',
                'description' => 'Menerjemahkan desain visual menjadi kode frontend yang presisi, responsif, fungsional, dan memiliki estetika Glassmorphism/Dark Mode.',
            ],

            // Backend Development
            [
                'name' => 'Laravel Ecosystem',
                'category' => 'Backend Development',
                'level' => 85,
                'icon' => 'fa-brands fa-laravel',
                'description' => 'Mengelola routing, controller, integrasi database Eloquent ORM, hingga deployment aplikasi live (hosting) seperti Railway.',
            ],
            [
                'name' => 'Python & Flask',
                'category' => 'Backend Development',
                'level' => 80,
                'icon' => 'fa-brands fa-python',
                'description' => 'Pembuatan algoritma kriptografi hibrida (AES-RSA), sistem reservasi tiket, kalkulator, serta API manajemen data mahasiswa dengan Flask.',
            ],
            [
                'name' => 'Database Management',
                'category' => 'Backend Development',
                'level' => 85,
                'icon' => 'fa-solid fa-database',
                'description' => 'Perancangan arsitektur database, normalisasi relasi data, dan operasi CRUD kompleks menggunakan MySQL dan SQLite.',
            ],

            // Tools & Others
            [
                'name' => 'Git & GitHub',
                'category' => 'Tools & Security',
                'level' => 85,
                'icon' => 'fa-brands fa-github',
                'description' => 'Manajemen versi kode dan kolaborasi aktif (20+ repositori) di platform GitHub.',
            ],
            [
                'name' => 'Security & Cryptography',
                'category' => 'Tools & Security',
                'level' => 75,
                'icon' => 'fa-solid fa-shield-halved',
                'description' => 'Pemahaman mengenai konsep keamanan sistem dan implementasi dasar enkripsi (AES/RSA).',
            ],
            [
                'name' => 'Mobile & Other Languages',
                'category' => 'Tools & Security',
                'level' => 65,
                'icon' => 'fa-solid fa-mobile-screen',
                'description' => 'Memiliki fondasi logika pemrograman yang kuat di C++ dan dasar pengembangan lintas platform menggunakan Flutter (Dart).',
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
                'title' => 'NFA_DASHBOARD',
                'description' => 'Sistem dashboard monitoring untuk pengelolaan data dan visualisasi performa infrastruktur secara terpusat.',
                'tech_stack' => ['PHP', 'MySQL', 'JavaScript', 'CSS'],
                'image_path' => 'images/projects/logistics.png',
                'project_url' => null,
                'github_url' => 'https://github.com/MuhammadAmirN/NFA_DASHBOARD',
                'featured' => true,
                'contribution_percentage' => 100,
            ],
            [
                'title' => 'DASHBOARD_IOT',
                'description' => 'Membangun aplikasi web IoT untuk praktikum bandul matematis. Meliputi pengembangan frontend, logika backend Laravel, integrasi database MySQL, hingga deployment dan hosting aplikasi.',
                'tech_stack' => ['Laravel', 'MySQL', 'JavaScript', 'IoT'],
                'image_path' => 'images/projects/logistics.png',
                'project_url' => null,
                'github_url' => 'https://github.com/MuhammadAmirN/Dashboard_IoT',
                'featured' => true,
                'contribution_percentage' => 100,
            ],
            [
                'title' => 'BOT_WHATSAPP_NODEJS',
                'description' => 'Sistem bot WhatsApp otomatis dan interaktif yang dibangun menggunakan ekosistem Node.js.',
                'tech_stack' => ['JavaScript', 'Node.js', 'WhatsApp API'],
                'image_path' => 'images/projects/ecommerce.png',
                'project_url' => null,
                'github_url' => 'https://github.com/MuhammadAmirN/botWA',
                'featured' => true,
                'contribution_percentage' => 100,
            ],
            [
                'title' => 'HYBRID-CRYTO-AES-RSA',
                'description' => 'Implementasi sistem keamanan data menggunakan algoritma hybrid (kombinasi AES dan RSA) untuk enkripsi dan dekripsi yang aman.',
                'tech_stack' => ['Python', 'Cryptography', 'Security'],
                'image_path' => 'images/projects/portfolio.png',
                'project_url' => null,
                'github_url' => 'https://github.com/MuhammadAmirN/HYBRID-CRYTO-AES-RSA',
                'featured' => true,
                'contribution_percentage' => 100,
            ],
            [
                'title' => 'PEMESANAN_TIKET_BOLA',
                'description' => 'Aplikasi berbasis web untuk manajemen pemesanan tiket pertandingan sepak bola dengan sistem verifikasi pembayaran.',
                'tech_stack' => ['PHP', 'MySQL', 'JavaScript'],
                'image_path' => 'images/projects/ecommerce.png',
                'project_url' => null,
                'github_url' => 'https://github.com/MuhammadAmirN/PEMESANAN_TIKET_BOLA',
                'featured' => false,
                'contribution_percentage' => 100,
            ],
            [
                'title' => 'RESERVASI_CAFE',
                'description' => 'Sistem manajemen reservasi meja dan pemesanan menu online untuk meningkatkan efisiensi operasional cafe.',
                'tech_stack' => ['PHP', 'MySQL', 'Bootstrap'],
                'image_path' => 'images/projects/ecommerce.png',
                'project_url' => null,
                'github_url' => 'https://github.com/MuhammadAmirN/RESERVASI_CAFE',
                'featured' => false,
                'contribution_percentage' => 100,
            ],
            [
                'title' => 'MANAJEMEN-DATA-MAHASISWA',
                'description' => 'Aplikasi API manajemen data mahasiswa menggunakan framework Flask dan database SQLite dengan fitur CRUD lengkap.',
                'tech_stack' => ['Python', 'Flask', 'SQLite'],
                'image_path' => 'images/projects/portfolio.png',
                'project_url' => null,
                'github_url' => 'https://github.com/MuhammadAmirN/MANAJEMEN-DATA-MAHASISWA-MENGGUNAKAN-FLASK-DAN-SQLITE',
                'featured' => false,
                'contribution_percentage' => 100,
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
