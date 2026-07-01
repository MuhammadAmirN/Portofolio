# 💼 Portofolio — Muhammad Amir Nurudin

Website portofolio personal berbasis **Laravel**, dibangun untuk menampilkan profil, skill, dan proyek-proyek yang telah dikerjakan. Website ini dilengkapi dashboard admin untuk mengelola skill, proyek, dan pesan masuk dari form kontak, serta fitur sinkronisasi otomatis repository GitHub ke dalam daftar proyek.

## ✨ Fitur

- **Landing Page Portofolio** — Menampilkan hero section, daftar skill (dikategorikan per bidang: Frontend, Backend, Tools & Security), daftar proyek, dan form kontak.
- **Dashboard Admin** — Panel admin untuk mengelola data skill, proyek, dan pesan masuk.
- **Autentikasi Admin** — Login khusus admin menggunakan Laravel Auth.
- **Sinkronisasi GitHub Otomatis** — Artisan command untuk menarik repository publik dari GitHub dan menambahkannya sebagai proyek secara otomatis.
- **Kategorisasi Skill** — Skill dikelompokkan berdasarkan kategori dan level penguasaan.
- **Statistik Proyek** — Menampilkan total proyek dan jumlah proyek unggulan (featured).
- **Desain Responsif** — Tampilan menyesuaikan berbagai ukuran perangkat (mobile-friendly).

## 🛠️ Tech Stack

- **Backend:** PHP 8.2+, Laravel 12
- **Frontend:** Blade Templates, Tailwind CSS 4, JavaScript
- **Build Tool:** Vite
- **Database:** SQLite (default), dapat dikonfigurasi ke MySQL
- **Auth:** Laravel built-in Authentication

## 📁 Struktur Utama
app/
├── Console/Commands/SyncGithubProjects.php   # Sinkronisasi proyek dari GitHub
├── Http/Controllers/
│   ├── PortfolioController.php               # Halaman utama portofolio
│   ├── AuthController.php                    # Login admin
│   ├── AdminController.php                   # Dashboard admin
│   ├── AdminSkillController.php              # CRUD skill
│   ├── AdminProjectController.php            # CRUD proyek
│   └── AdminMessageController.php            # Kelola pesan masuk
├── Models/
│   ├── Skill.php
│   ├── Project.php
│   ├── Message.php
│   └── User.php
database/
├── migrations/                                # Struktur tabel skills, projects, messages
└── seeders/DatabaseSeeder.php                 # Data awal skill & proyek
resources/
├── views/
│   ├── portfolio.blade.php                    # Halaman utama
│   └── admin/                                 # View dashboard admin

## 🚀 Instalasi & Menjalankan Secara Lokal

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js & NPM

### Langkah-langkah

1. **Clone repository**
```bash
   git clone https://github.com/MuhammadAmirN/Portofolio.git
   cd Portofolio
```

2. **Install dependency PHP**
```bash
   composer install
```

3. **Install dependency JavaScript**
```bash
   npm install
```

4. **Salin file environment**
```bash
   cp .env.example .env
```

5. **Generate application key**
```bash
   php artisan key:generate
```

6. **Siapkan database SQLite**
```bash
   touch database/database.sqlite
   php artisan migrate
```

7. **Seed data awal (skill & proyek)**
```bash
   php artisan db:seed
```
   > ⚠️ Setelah seeding, segera ganti password admin default melalui database atau fitur ubah password, jangan gunakan kredensial bawaan di environment production.

8. **Build asset frontend**
```bash
   npm run build
```

9. **Jalankan server lokal**
```bash
   php artisan serve
```
   Atau jalankan semua service sekaligus (server, queue, log, vite) dengan:
```bash
   composer run dev
```

10. Akses aplikasi di `http://localhost:8000`

## 🔄 Sinkronisasi Proyek dari GitHub

Untuk menarik otomatis repository publik GitHub sebagai data proyek:

```bash
php artisan app:sync-github-projects MuhammadAmirN
```

## 🔐 Environment Variables Penting

| Variabel | Keterangan |
|---|---|
| `APP_URL` | URL aplikasi |
| `DB_CONNECTION` | Jenis koneksi database (default: `sqlite`) |
| `MAIL_*` | Konfigurasi pengiriman email (opsional, untuk fitur kontak) |

## 📌 Catatan

- Proyek ini masih dalam pengembangan aktif — beberapa fitur seperti routing dashboard admin mungkin masih disempurnakan.
- Gambar proyek dan CV disimpan di folder `public/images/`.

## 👤 Kontak

**Muhammad Amir Nurudin**
- GitHub: [@MuhammadAmirN](https://github.com/MuhammadAmirN)
- LinkedIn: [muh-amir-n](https://linkedin.com/in/muh-amir-n-a1a94b418/)

## 📝 Lisensi

Proyek ini bersifat open-source dan dapat digunakan sebagai referensi pembelajaran.
