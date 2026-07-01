<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(): View
    {
        $skills = collect([
            [
                'name' => 'Laravel',
                'category' => 'Backend Development',
                'level' => 95,
                'icon' => 'fa-brands fa-laravel',
                'description' => 'Membangun aplikasi web dengan arsitektur yang rapi dan maintainable.',
            ],
            [
                'name' => 'PHP',
                'category' => 'Backend Development',
                'level' => 92,
                'icon' => 'fa-brands fa-php',
                'description' => 'Pengembangan backend dan logika aplikasi berbasis PHP modern.',
            ],
            [
                'name' => 'Node.js',
                'category' => 'Backend Development',
                'level' => 80,
                'icon' => 'fa-brands fa-node-js',
                'description' => 'Server-side JavaScript untuk automation dan API sederhana.',
            ],
            [
                'name' => 'JavaScript',
                'category' => 'Frontend Development',
                'level' => 94,
                'icon' => 'fa-brands fa-js',
                'description' => 'Interaksi UI, animasi, dan pengalaman pengguna yang responsif.',
            ],
            [
                'name' => 'HTML & CSS',
                'category' => 'Frontend Development',
                'level' => 96,
                'icon' => 'fa-brands fa-html5',
                'description' => 'Menyusun tampilan web yang rapi, adaptif, dan konsisten.',
            ],
            [
                'name' => 'Flutter',
                'category' => 'Frontend Development',
                'level' => 78,
                'icon' => 'fa-brands fa-uncharted',
                'description' => 'Membangun UI mobile yang cepat dan mudah dipelihara.',
            ],
            [
                'name' => 'MySQL',
                'category' => 'Database & Tools',
                'level' => 88,
                'icon' => 'fa-solid fa-database',
                'description' => 'Perancangan database relasional dan query dasar yang efisien.',
            ],
            [
                'name' => 'Git & GitHub',
                'category' => 'Database & Tools',
                'level' => 90,
                'icon' => 'fa-brands fa-github',
                'description' => 'Version control, kolaborasi, dan deployment berbasis repository.',
            ],
            [
                'name' => 'Python',
                'category' => 'Database & Tools',
                'level' => 84,
                'icon' => 'fa-brands fa-python',
                'description' => 'Otomasi, scripting, dan proyek berbasis data atau desktop.',
            ],
        ])->groupBy('category')->map(function ($items) {
            return $items->map(function ($skill) {
                return (object) $skill;
            })->values();
        });

        $canonicalProjects = collect([
            [
                'title' => 'Website Laundry Mataram',
                'description' => 'Platform e-commerce laundry berbasis Laravel untuk pemesanan layanan dan pengelolaan transaksi di Mataram laundry.',
                'tech_stack' => ['Laravel', 'MySQL', 'Bootstrap'],
                'role' => 'Fullstack Developer',
                'image_path' => 'images/projects/Loundry_mataram.png',
                'project_url' => null,
                'github_url' => 'https://github.com/MuhammadAmirN/website_online_loundry',
                'featured' => true,
                'contribution_percentage' => 100,
            ],
            [
                'title' => 'Dashboard IoT',
                'description' => 'Membangun aplikasi web IoT untuk praktikum bandul matematis. Meliputi pengembangan frontend, Api, logika backend Laravel, integrasi database MySQL, hingga deployment dan hosting aplikasi.',
                'tech_stack' => ['Laravel', 'MySQL', 'JavaScript', 'IoT'],
                'role' => 'Fullstack Developer',
                'image_path' => 'images/projects/iot.png',
                'project_url' => null,
                'github_url' => 'https://github.com/MuhammadAmirN/Dashboard_IoT',
                'featured' => true,
                'contribution_percentage' => 100,
            ],
            [
                'title' => 'Enkripsi Data',
                'description' => 'Aplikasi edukasi dan simulasi enkripsi data untuk melindungi informasi menggunakan algoritma kriptografi.',
                'tech_stack' => ['Python', 'Cryptography', 'Security'],
                'role' => 'Python Developer',
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
                'featured' => false,
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
                'tech_stack' => ['Java', 'Swing', 'MySQL'],
                'role' => 'JavaBackend Developer',
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
                'role' => 'Java Developer',
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
                'title' => 'Bot WhatsApp',
                'description' => 'Bot WhatsApp otomatis berbasis Node.js dan JavaScript untuk merespons pesan, menjalankan perintah, dan mempermudah interaksi pengguna melalui chat.',
                'tech_stack' => ['Node.js', 'JavaScript'],
                'role' => 'Backend Developer',
                'image_path' => null,
                'project_url' => null,
                'github_url' => 'https://github.com/MuhammadAmirN/botWA',
                'featured' => false,
                'contribution_percentage' => 100,
            ],
        ]);

        $projects = $canonicalProjects->map(function (array $project): object {
            return (object) $project;
        })->values();

        return view('portfolio', compact('skills', 'projects'));
    }
}
