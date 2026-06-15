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

            // CLI Skills
            [
                'name' => 'Artisan CLI',
                'category' => 'CLI Skills',
                'level' => 85,
                'icon' => 'fa-solid fa-terminal',
                'description' => 'Otomasi pengembangan Laravel menggunakan command line interface.',
            ],
            [
                'name' => 'Git Bash / Terminal',
                'category' => 'CLI Skills',
                'level' => 80,
                'icon' => 'fa-solid fa-code',
                'description' => 'Manajemen file, navigasi sistem, dan version control melalui baris perintah.',
            ],
            [
                'name' => 'NPM / Composer CLI',
                'category' => 'CLI Skills',
                'level' => 75,
                'icon' => 'fa-solid fa-box-open',
                'description' => 'Manajemen dependensi proyek frontend dan backend via terminal.',
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
                'description' => 'Platform monitoring Internet of Things (IoT) untuk memantau data sensor secara real-time dengan antarmuka yang intuitif.',
                'tech_stack' => ['JavaScript', 'IoT', 'API', 'CSS'],
                'image_path' => 'images/projects/logistics.png',
                'project_url' => null,
                'github_url' => 'https://github.com/MuhammadAmirN/DASHBOARD_IOT',
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
                'title' => 'WEBSITE_ONLINE_LOUNDRY',
                'description' => 'Layanan manajemen laundry online yang memungkinkan pelanggan memantau status cucian mereka secara transparan.',
                'tech_stack' => ['Laravel', 'MySQL', 'Tailwind CSS'],
                'image_path' => 'images/projects/ecommerce.png',
                'project_url' => null,
                'github_url' => 'https://github.com/MuhammadAmirN/WEBSITE_ONLINE_LOUNDRY',
                'featured' => false,
                'contribution_percentage' => 95,
            ],
            [
                'title' => 'MANAJEMEN-DATA-MAHASISWA',
                'description' => 'Aplikasi manajemen data mahasiswa menggunakan framework Flask dan database SQLite dengan fitur CRUD lengkap.',
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
