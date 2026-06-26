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
            [
                'name' => 'Java Desktop Development',
                'category' => 'Backend Development',
                'level' => 72,
                'icon' => 'fa-brands fa-java',
                'description' => 'Membangun aplikasi desktop Java untuk sistem kasir dan review dengan GUI dan koneksi database.',
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
            [
                'name' => 'Flask API & Streamlit',
                'category' => 'Backend Development',
                'level' => 78,
                'icon' => 'fa-solid fa-gears',
                'description' => 'Membuat REST API sederhana dan aplikasi data interaktif berbasis Python untuk manajemen data dan booking.',
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
            [
                'name' => 'Deployment & Hosting',
                'category' => 'Tools & Security',
                'level' => 80,
                'icon' => 'fa-solid fa-cloud-arrow-up',
                'description' => 'Menangani deployment aplikasi web ke hosting dan Railway dengan konfigurasi environment yang rapi.',
            ],
        ];

        foreach ($skillsData as $skill) {
            Skill::updateOrCreate(
                ['name' => $skill['name']],
                $skill
            );
        }

        $legacyProjectUpdates = [
            [
                'match' => ['title' => 'Website Online Laundry'],
                'data' => [
                    'title' => 'Website Laundry Mataram',
                    'description' => 'Platform e-commerce laundry berbasis Laravel untuk pemesanan layanan dan pengelolaan transaksi di Mataram.',
                    'tech_stack' => ['Laravel', 'MySQL', 'Bootstrap'],
                    'role' => 'Fullstack Developer',
                    'image_path' => 'images/projects/Loundry_mataram.png',
                    'project_url' => null,
                    'github_url' => 'https://github.com/MuhammadAmirN/website_online_loundry',
                    'featured' => false,
                    'contribution_percentage' => 100,
                    'slug' => Str::slug('Website Laundry Mataram') . '-' . rand(1000, 9999),
                ],
            ],
            [
                'match' => ['title' => 'Bot WhatsApp Node.js'],
                'data' => [
                    'title' => 'Enkripsi Data',
                    'description' => 'Aplikasi edukasi dan simulasi enkripsi data untuk melindungi informasi menggunakan algoritma kriptografi.',
                    'tech_stack' => ['Java', 'Cryptography', 'Security'],
                    'role' => 'Java Developer',
                    'image_path' => 'images/projects/membuat-enkripsi-data.png',
                    'project_url' => null,
                    'github_url' => 'https://github.com/MuhammadAmirN/membuat-enkripsi-data',
                    'featured' => true,
                    'contribution_percentage' => 100,
                    'slug' => Str::slug('Enkripsi Data') . '-' . rand(1000, 9999),
                ],
            ],
            [
                'match' => ['title' => 'Sistem Laundry Mataram'],
                'data' => [
                    'title' => 'Membuat Navigasi',
                    'description' => 'Project Flutter untuk membuat navigasi antar halaman dan struktur perpindahan layar aplikasi mobile.',
                    'tech_stack' => ['Flutter', 'Dart', 'Mobile App'],
                    'role' => 'Mobile Developer',
                    'image_path' => 'images/projects/Navigasi_flutter.png',
                    'project_url' => null,
                    'github_url' => 'https://github.com/MuhammadAmirN/membuat_navigasi',
                    'featured' => true,
                    'contribution_percentage' => 100,
                    'slug' => Str::slug('Membuat Navigasi') . '-' . rand(1000, 9999),
                ],
            ],
            [
                'match' => ['title' => 'Landing Page Portofolio'],
                'data' => [
                    'title' => 'Login dan Merubah Background Flutter',
                    'description' => 'Project Flutter untuk membuat halaman login sederhana dan fitur mengubah background tampilan aplikasi.',
                    'tech_stack' => ['Flutter', 'Dart', 'Mobile App'],
                    'role' => 'Mobile Developer',
                    'image_path' => 'images/projects/Navigasi_flutter.png',
                    'project_url' => null,
                    'github_url' => 'https://github.com/MuhammadAmirN/login-dan-merubah-background-flutter-',
                    'featured' => false,
                    'contribution_percentage' => 100,
                    'slug' => Str::slug('Login dan Merubah Background Flutter') . '-' . rand(1000, 9999),
                ],
            ],
        ];

        foreach ($legacyProjectUpdates as $legacyUpdate) {
            Project::updateOrCreate(
                $legacyUpdate['match'],
                $legacyUpdate['data']
            );
        }

        // 3. Seed Projects
        $projectsData = [
            [
                'title' => 'Website Laundry Mataram',
                'description' => 'Platform e-commerce laundry berbasis Laravel untuk pemesanan layanan dan pengelolaan transaksi di Mataram.',
                'tech_stack' => ['Laravel', 'MySQL', 'Bootstrap'],
                'role' => 'Fullstack Developer',
                'image_path' => 'images/projects/Loundry_mataram.png',
                'project_url' => null,
                'github_url' => 'https://github.com/MuhammadAmirN/website_online_loundry',
                'featured' => false,
                'contribution_percentage' => 100,
            ],
            [
                'title' => 'Dashboard IoT',
                'description' => 'Membangun aplikasi web IoT untuk praktikum bandul matematis. Meliputi pengembangan frontend, logika backend Laravel, integrasi database MySQL, hingga deployment dan hosting aplikasi.',
                'tech_stack' => ['Laravel', 'MySQL', 'JavaScript', 'IoT'],
                'role' => 'Fullstack Developer',
                'image_path' => 'images/projects/Dashboard_IoT.png',
                'project_url' => null,
                'github_url' => 'https://github.com/MuhammadAmirN/Dashboard_IoT',
                'featured' => true,
                'contribution_percentage' => 100,
            ],
            [
                'title' => 'Enkripsi Data',
                'description' => 'Aplikasi edukasi dan simulasi enkripsi data untuk melindungi informasi menggunakan algoritma kriptografi.',
                'tech_stack' => ['Java', 'Cryptography', 'Security'],
                'role' => 'Java Developer',
                'image_path' => 'images/projects/membuat-enkripsi-data.png',
                'project_url' => null,
                'github_url' => 'https://github.com/MuhammadAmirN/membuat-enkripsi-data',
                'featured' => true,
                'contribution_percentage' => 100,
            ],
            [
                'title' => 'Pemesanan Tiket Bola',
                'description' => 'Aplikasi berbasis web untuk manajemen pemesanan tiket pertandingan sepak bola dengan sistem verifikasi pembayaran.',
                'tech_stack' => ['Python', 'Streamlit', 'Data Processing'],
                'role' => 'Python Developer',
                'image_path' => 'images/projects/pemesanan_tiket_bola.png',
                'project_url' => null,
                'github_url' => 'https://github.com/MuhammadAmirN/PEMESANAN_TIKET_BOLA',
                'featured' => false,
                'contribution_percentage' => 100,
            ],
            [
                'title' => 'Pemesanan Laundry',
                'description' => 'Sistem pemesanan laundry berbasis Python untuk pencatatan order, layanan, dan status pengerjaan.',
                'tech_stack' => ['Python', 'OOP', 'Desktop App'],
                'role' => 'Python Developer',
                'image_path' => 'images/projects/pemesanan-loundry_py.png',
                'project_url' => null,
                'github_url' => 'https://github.com/MuhammadAmirN/pemesanan-loundry',
                'featured' => false,
                'contribution_percentage' => 100,
            ],
            [
                'title' => 'Membuat Navigasi',
                'description' => 'Project Flutter untuk membuat navigasi antar halaman dan struktur perpindahan layar aplikasi mobile.',
                'tech_stack' => ['Flutter', 'Dart', 'Mobile App'],
                'role' => 'Mobile Developer',
                'image_path' => 'images/projects/Navigasi_flutter.png',
                'project_url' => null,
                'github_url' => 'https://github.com/MuhammadAmirN/membuat_navigasi',
                'featured' => true,
                'contribution_percentage' => 100,
            ],
            [
                'title' => 'Reservasi Cafe',
                'description' => 'Sistem manajemen reservasi meja dan pemesanan menu online untuk meningkatkan efisiensi operasional cafe.',
                'tech_stack' => ['PHP', 'MySQL', 'Bootstrap'],
                'role' => 'Fullstack Developer',
                'image_path' => 'images/projects/reservasi_cafe.png',
                'project_url' => null,
                'github_url' => 'https://github.com/MuhammadAmirN/RESERVASI_CAFE',
                'featured' => false,
                'contribution_percentage' => 100,
            ],
            [
                'title' => 'Manajemen Data Mahasiswa',
                'description' => 'Aplikasi API manajemen data mahasiswa menggunakan framework Flask dan database SQLite dengan fitur CRUD lengkap.',
                'tech_stack' => ['Python', 'Flask', 'SQLite'],
                'role' => 'Backend Developer',
                'image_path' => 'images/projects/data-mhs.png',
                'project_url' => null,
                'github_url' => 'https://github.com/MuhammadAmirN/MANAJEMEN-DATA-MAHASISWA-MENGGUNAKAN-FLASK-DAN-SQLITE',
                'featured' => true,
                'contribution_percentage' => 100,
            ],
            [
                'title' => 'Portofolio Website',
                'description' => 'Website portofolio personal untuk menampilkan skill, project, dan form kontak secara profesional.',
                'tech_stack' => ['Laravel', 'Blade', 'CSS', 'JavaScript'],
                'role' => 'Fullstack Developer',
                'image_path' => 'images/projects/portfolio.png',
                'project_url' => null,
                'github_url' => 'https://github.com/MuhammadAmirN/Portofolio',
                'featured' => true,
                'contribution_percentage' => 100,
            ],
            [
                'title' => 'Sistem Kasir Sederhana',
                'description' => 'Aplikasi desktop Java untuk transaksi kasir, inventory, dan laporan penjualan.',
                'tech_stack' => ['Java', 'Swing', 'MySQL'],
                'role' => 'Fullstack Developer',
                'image_path' => 'images/projects/kasir_java.png',
                'project_url' => null,
                'github_url' => 'https://github.com/MuhammadAmirN/kasir-sederhana',
                'featured' => false,
                'contribution_percentage' => 100,
            ],
            [
                'title' => 'Review System',
                'description' => 'Sistem penilaian dan review berbasis Java dengan GUI untuk input rating dan ulasan pengguna.',
                'tech_stack' => ['Java', 'Swing', 'Database'],
                'role' => 'Java Developer',
                'image_path' => 'images/projects/penilaian-pada-e-commerce.png',
                'project_url' => null,
                'github_url' => 'https://github.com/MuhammadAmirN/membuat-penilaian-review',
                'featured' => false,
                'contribution_percentage' => 100,
            ],
            [
                'title' => 'Login dan Merubah Background Flutter',
                'description' => 'Project Flutter untuk membuat halaman login sederhana dan fitur mengubah background tampilan aplikasi.',
                'tech_stack' => ['Flutter', 'Dart', 'Mobile App'],
                'role' => 'Mobile Developer',
                'image_path' => 'images/projects/Navigasi_flutter.png',
                'project_url' => null,
                'github_url' => 'https://github.com/MuhammadAmirN/login-dan-merubah-background-flutter-',
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
