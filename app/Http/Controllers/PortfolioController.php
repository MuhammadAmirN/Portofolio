<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PortfolioController extends Controller
{
    public function index(): View
    {
        $skills = Skill::orderBy('level', 'desc')->get()->groupBy('category');
        $canonicalProjects = collect([
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
                'title' => 'Sistem Laundry Mataram',
                'description' => 'Sistem manajemen laundry lengkap dengan fitur CRUD, role-based access control, dan laporan keuangan.',
                'tech_stack' => ['Laravel', 'MySQL', 'Bootstrap', 'PHP'],
                'role' => 'Fullstack Developer',
                'image_path' => 'images/projects/Loundry_mataram.png',
                'project_url' => null,
                'github_url' => 'https://github.com/MuhammadAmirN/loundry_mataram-laravel',
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
                'title' => 'Landing Page Portofolio',
                'description' => 'Landing page personal untuk menampilkan profil, skill, dan akses cepat ke project utama.',
                'tech_stack' => ['Laravel', 'Blade', 'CSS'],
                'role' => 'Frontend Developer',
                'image_path' => 'images/projects/portfolio.png',
                'project_url' => null,
                'github_url' => 'https://github.com/MuhammadAmirN/Portofolio',
                'featured' => false,
                'contribution_percentage' => 100,
            ],
        ]);

        $projects = $canonicalProjects->map(function (array $project): object {
            return (object) $project;
        })->values();

        return view('portfolio', compact('skills', 'projects'));
    }

    public function storeContact(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        Message::create($validated);

        return redirect()->back()->with('success', 'Pesan Anda telah berhasil dikirim. Terima kasih!');
    }
}
