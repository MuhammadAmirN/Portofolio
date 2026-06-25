@extends('layouts.app')

@section('content')

    <!-- Hero Section -->
    <section id="home" class="section hero" style="padding-top: 2rem;">
        <div class="container hero-inner">
            <div class="hero-content">
                <span class="hero-tag">Fullstack Web Developer | AI-Augmented Engineer</span>
                <h1 class="hero-title">
                    Hi, I'm <span>Muhammad Amir Nurudin</span>.
                </h1>
                <p class="hero-desc">
                    Mahasiswa IT Semester 6 yang berfokus membangun produk digital modern, responsif, dan <em>user-centric</em>. Saya mengintegrasikan teknologi Frontend & Backend dengan bantuan perkakas AI modern untuk menghasilkan solusi yang efisien, cepat, dan <em>scalable</em>.
                </p>
                <div class="hero-actions">
                    <a href="#projects" class="btn btn-primary">Lihat Proyek</a>
                    <a href="#" class="btn btn-secondary" onclick="openCvModal(); return false;"><i class="fa-solid fa-download" style="margin-right: 0.5rem;"></i>Download CV</a>
                </div>
            </div>
            
            <div class="hero-illustration">
                <div class="hero-img-glow"></div>
                <div class="hero-avatar-card glass-card">
                    <img src="{{ asset('images/avatar.jpg') }}" alt="Muhammad Amir Nurudin" class="hero-avatar">
                    <h3 class="hero-avatar-name">Amir Nurudin</h3>
                    <p class="hero-avatar-title">Fullstack Developer • Front End Focus</p>
                    <div class="hero-socials">
                        <a href="https://github.com/MuhammadAmirN" target="_blank" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
                        <a href="https://linkedin.com/in/muh-amir-n-a1a94b418/" target="_blank" aria-label="LinkedIn"><i class="fa-brands fa-linkedin"></i></a>
                        <a href="mailto:muhamir6n@gmail.com" aria-label="Email"><i class="fa-solid fa-envelope"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="section projects">
        <div class="container">
            <div class="section-header">
                <span class="section-subtitle">Portofolio</span>
                <h2 class="section-title">Proyek Unggulan</h2>
            </div>
            
            @php
                $projectImageMap = [
                    'Dashboard IoT' => 'images/projects/Dashboard_IoT.png',
                    'Website Laundry Mataram' => 'images/projects/Loundry_mataram.png',
                    'Enkripsi Data' => 'images/projects/membuat-enkripsi-data.png',
                    'Pemesanan Tiket Bola' => 'images/projects/pemesanan_tiket_bola.png',
                    'Pemesanan Laundry' => 'images/projects/pemesanan-loundry_py.png',
                    'Reservasi Cafe' => 'images/projects/reservasi_cafe.png',
                    'Manajemen Data Mahasiswa' => 'images/projects/data-mhs.png',
                    'Portfolio Website' => 'images/projects/portfolio.png',
                    'Sistem Kasir Sederhana' => 'images/projects/kasir_java.png',
                    'Review System' => 'images/projects/penilaian-pada-e-commerce.png',
                ];
                $uniqueTags = [];
                foreach($projects as $p) {
                    if ($p->tech_stack && is_array($p->tech_stack)) {
                        foreach($p->tech_stack as $t) {
                            $uniqueTags[] = trim($t);
                        }
                    }
                }
                $uniqueTags = array_unique($uniqueTags);
            @endphp

            <div class="projects-filter">
                <button class="filter-btn active" data-filter="all">Semua</button>
                @foreach($uniqueTags as $tag)
                    <button class="filter-btn" data-filter="{{ strtolower($tag) }}">{{ $tag }}</button>
                @endforeach
            </div>
            
            <div class="projects-grid">
                @foreach($projects as $project)
                    <div class="project-card-wrapper" data-categories="{{ implode(',', $project->tech_stack ?: []) }}">
                        <article class="project-card glass-card @if($project->featured) featured-card @endif">
                            <div class="project-img-wrapper">
                                @php
                                    $resolvedImagePath = $project->image_path ?: ($projectImageMap[$project->title] ?? null);
                                @endphp
                                @if($resolvedImagePath)
                                    @php
                                        $imageSrc = str_starts_with($resolvedImagePath, 'images/')
                                            ? asset($resolvedImagePath)
                                            : asset('storage/' . $resolvedImagePath);
                                    @endphp
                                    <a href="{{ $project->github_url }}" target="_blank" rel="noreferrer" class="project-card-media-link" aria-label="Lihat source code {{ $project->title }}">
                                        <img src="{{ $imageSrc }}" alt="{{ $project->title }}" class="project-img" loading="lazy">
                                    </a>
                                @else
                                    <a href="{{ $project->github_url }}" target="_blank" rel="noreferrer" class="project-card-media-link" aria-label="Lihat source code {{ $project->title }}">
                                        <div style="display:flex;align-items:center;justify-content:center;height:100%;color:var(--text-muted);">
                                            <i class="fa-solid fa-image fa-3x"></i>
                                        </div>
                                    </a>
                                @endif
                            </div>
                            
                            <div class="project-content">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                    <h3 class="project-title" style="margin-bottom: 0;">
                                        <a href="{{ $project->github_url }}" target="_blank" rel="noreferrer" style="color: inherit; text-decoration: none;">
                                            {{ $project->title }}
                                        </a>
                                    </h3>
                                    <span class="project-tag" style="background: rgba(99, 102, 241, 0.1); color: #818cf8; border: 1px solid rgba(99, 102, 241, 0.2); font-weight: bold;">
                                        Peran: {{ $project->role ?? 'Fullstack' }}
                                    </span>
                                </div>
                                
                                <div class="project-desc-box" style="margin: 1rem 0; padding: 0.75rem; background: rgba(0,0,0,0.2); border-radius: 8px; font-size: 0.95rem; color: #d1d5db;">
                                    <p style="margin-bottom: 0;"><strong>Deskripsi:</strong> {{ $project->description }}</p>
                                </div>
                                
                                <div class="project-tags">
                                    @foreach($project->tech_stack ?: [] as $tech)
                                        <span class="project-tag">{{ $tech }}</span>
                                    @endforeach
                                </div>
                                
                                <div class="project-links">
                                    @if($project->project_url)
                                        <a href="{{ $project->project_url }}" target="_blank" class="project-link">
                                            <i class="fa-solid fa-arrow-up-right-from-square"></i> Live Demo
                                        </a>
                                    @endif
                                    @if($project->github_url)
                                        <a href="{{ $project->github_url }}" target="_blank" rel="noreferrer" class="project-link">
                                            <i class="fa-brands fa-github"></i> Source Code
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="section skills">
        <div class="container">
            <div class="section-header">
                <span class="section-subtitle">Keahlian & Alat Bantu</span>
                <h2 class="section-title">Teknologi yang Saya Kuasai</h2>
            </div>
            
            <div class="skills-grid" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));">
                @foreach($skills as $category => $items)
                    <div class="skills-category glass-card" style="padding: 2rem;">
                        <h3 class="skills-category-title" style="margin-bottom: 1.5rem; font-size: 1.25rem;">
                            @if($category === 'Backend Development')
                                <i class="fa-solid fa-server" style="color: var(--primary-color);"></i>
                            @elseif($category === 'Frontend Development')
                                <i class="fa-solid fa-laptop-code" style="color: var(--primary-color);"></i>
                            @else
                                <i class="fa-solid fa-microchip" style="color: var(--primary-color);"></i>
                            @endif
                            {{ $category }}
                        </h3>
                        
                        <div class="skills-badges" style="display: flex; flex-wrap: wrap; gap: 0.75rem;">
                            @foreach($items as $skill)
                                <div class="skill-badge" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 0.5rem 1rem; border-radius: 20px; display: flex; align-items: center; gap: 0.5rem; font-weight: 500; transition: all 0.3s ease;">
                                    <i class="{{ $skill->icon ?: 'fa-solid fa-circle-nodes' }}" style="color: var(--primary-color);"></i>
                                    {{ $skill->name }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section about">
        <div class="container">
            <div class="section-header">
                <span class="section-subtitle">Tentang Saya</span>
                <h2 class="section-title">Membangun Solusi Digital</h2>
            </div>
            
            <div class="about-grid">
                <div class="about-text">
                    <p>
                        Saat ini saya berada di <strong>Semester 6 Program Studi Teknologi Informasi</strong> di <strong>Universitas Duta Bangsa Surakarta</strong> (Angkatan 2023). Saya memiliki passion besar dalam ekosistem pengembangan perangkat lunak modern.
                    </p>
                    <p>
                        Sebagai mahasiswa yang proaktif, saya sangat antusias mengaplikasikan pengetahuan teknis saya ke dunia nyata. <strong>Oleh karena itu, saya secara aktif terbuka dan mencari peluang Magang (Internship) maupun Junior Developer Position</strong> di perusahaan Anda untuk memberikan dampak positif sekaligus menajamkan keahlian industri saya.
                    </p>
                    <div style="margin-top: 2rem;">
                        <a href="#contact" class="btn btn-secondary"><i class="fa-solid fa-paper-plane" style="margin-right: 0.5rem;"></i>Mari Berdiskusi</a>
                    </div>
                </div>
                
                <div class="about-stats">
                    <div class="stat-card glass-card">
                        <div class="stat-number">2023</div>
                        <div class="stat-label">Tahun Angkatan</div>
                    </div>
                    <div class="stat-card glass-card">
                        <div class="stat-number">6</div>
                        <div class="stat-label">Semester Saat Ini</div>
                    </div>
                    <div class="stat-card glass-card">
                        <div class="stat-number">Full</div>
                        <div class="stat-label">Stack Focus</div>
                    </div>
                    <div class="stat-card glass-card">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">Internship Ready</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section contact">
        <div class="container">
            <div class="section-header">
                <span class="section-subtitle">Kontak</span>
                <h2 class="section-title">Hubungi Saya</h2>
            </div>
            
            <div class="contact-grid">
                <div class="contact-info">
                    <h3 style="font-size: 1.5rem; margin-bottom: 1.5rem;">Mari Bekerja Sama</h3>
                    <p style="color: var(--text-secondary); margin-bottom: 2rem; font-size: 1.05rem;">
                        Apakah Anda memiliki proyek menarik, tawaran magang/pekerjaan, atau sekadar ingin menyapa? Silakan kirimkan pesan, saya akan merespons secepat mungkin.
                    </p>
                    
                    <div class="contact-info-list">
                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div class="contact-info-details">
                                <h4>Email</h4>
                                <p>muhamir6n@gmail.com</p>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div class="contact-info-details">
                                <h4>Lokasi</h4>
                                <p>Surakarta, Indonesia</p>
                            </div>
                        </div>
                    </div>
                    
                    <h4 class="contact-social-title">Ikuti Saya</h4>
                    <div class="contact-socials">
                        <a href="https://github.com/MuhammadAmirN" target="_blank" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
                        <a href="https://linkedin.com/in/muh-amir-n-a1a94b418/" target="_blank" aria-label="LinkedIn"><i class="fa-brands fa-linkedin"></i></a>
                        <a href="mailto:muhamir6n@gmail.com" aria-label="Email"><i class="fa-solid fa-envelope"></i></a>
                    </div>
                </div>
                
                <div class="contact-form-card glass-card">
                    <!-- Session Success / Error Alert -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="fa-solid fa-circle-check" style="margin-right: 0.5rem;"></i> {{ session('success') }}
                        </div>
                    @endif
                    
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <i class="fa-solid fa-circle-xmark" style="margin-right: 0.5rem;"></i> Harap periksa formulir di bawah untuk kesalahan.
                        </div>
                    @endif

                    <form action="{{ route('portfolio.contact') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Nama Anda" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Alamat Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="email@contoh.com" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="subject" class="form-label">Subjek</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Tujuan pesan (Misal: Tawaran Magang)" value="{{ old('subject') }}">
                            @error('subject')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="message" class="form-label">Pesan</label>
                            <textarea name="message" id="message" rows="5" class="form-control" placeholder="Tuliskan detail pesan Anda di sini..." required>{{ old('message') }}</textarea>
                            @error('message')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">
                            <i class="fa-solid fa-paper-plane" style="margin-right: 0.5rem;"></i>Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- CV Modal -->
    <div id="cvPreviewModal" class="cv-modal">
        <div class="cv-modal-content">
            <span class="cv-close-btn" onclick="closeCvModal()">&times;</span>
            <div style="text-align: right; margin-bottom: 1rem;">
                <button class="btn btn-primary" onclick="window.print()">
                    <i class="fa-solid fa-file-pdf" style="margin-right: 0.5rem;"></i> Simpan sebagai PDF
                </button>
            </div>
            
            <div class="cv-paper">
                <div class="cv-body">
                    <!-- CV Header -->
                    <div class="cv-header-section">
                        <h1 class="cv-name">MUHAMMAD AMIR NURUDIN</h1>
                        <div class="cv-contact-info">
                            <span>+62 821-4515-3914</span> |
                            <span>muhamir6n@gmail.com</span> |
                            <span>Klaten, Jawa Tengah</span>
                        </div>
                        <div class="cv-contact-links">
                            <span>linkedin.com/in/muh-amir-n-a1a94b418/</span> |
                            <span>github.com/MuhammadAmirN</span> |
                            <span>Portfolio: amirdev.me</span>
                        </div>
                    </div>
                    
                    <!-- Profil Section -->
                    <div class="cv-section">
                        <h2 class="cv-section-title-ats">PROFIL</h2>
                        <div class="cv-section-line"></div>
                        <p class="cv-text">
                            Mahasiswa Teknik Informatika Semester 6 di Universitas Duta Bangsa Surakarta yang fokus pada fullstack web development, IoT, dan pengembangan berbasis AI tools. Berpengalaman membangun aplikasi dengan Laravel, Python, Java, dan Node.js dari desain database sampai antarmuka. Siap berkontribusi pada proyek internship maupun junior developer dengan pendekatan yang rapi, cepat belajar, dan berorientasi hasil.
                        </p>
                    </div>
                    
                    <!-- Pendidikan Section -->
                    <div class="cv-section">
                        <h2 class="cv-section-title-ats">PENDIDIKAN</h2>
                        <div class="cv-section-line"></div>
                        <div class="cv-item-ats">
                            <div class="cv-item-header">
                                <span class="cv-item-title">S1 Teknik Informatika - Universitas Duta Bangsa Surakarta</span>
                                <span class="cv-item-date">2023 - Sekarang</span>
                            </div>
                            <div class="cv-item-subtitle-ats">Semester 6 (Aktif) | IPK Terakhir: 4.00</div>
                            <p class="cv-text-muted">Mata Kuliah Relevan: Pemrograman Web, Pemrograman Mobile, Basis Data, Internet of Things (IoT), Struktur Data, Rekayasa Perangkat Lunak.</p>
                        </div>
                    </div>
                    
                    <!-- Keahlian Teknis Section -->
                    <div class="cv-section">
                        <h2 class="cv-section-title-ats">KEAHLIAN TEKNIS</h2>
                        <div class="cv-section-line"></div>
                        <div class="cv-skills-grid">
                            <p class="cv-text" style="margin-bottom: 0.25rem;"><strong>Frontend:</strong> HTML5, CSS3, JavaScript, Bootstrap, Tailwind, Blade, responsive UI</p>
                            <p class="cv-text" style="margin-bottom: 0.25rem;"><strong>Backend:</strong> PHP/Laravel, Python/Flask, Node.js/Express, Java</p>
                            <p class="cv-text" style="margin-bottom: 0.25rem;"><strong>Database:</strong> MySQL, SQLite, query design, normalization, CRUD</p>
                            <p class="cv-text" style="margin-bottom: 0.25rem;"><strong>IoT:</strong> ESP32, Arduino, sensor integration, Wokwi, dashboard monitoring</p>
                            <p class="cv-text" style="margin-bottom: 0.25rem;"><strong>Tools:</strong> Git, GitHub, REST API, deployment, debugging</p>
                            <p class="cv-text" style="margin-bottom: 0;"><strong>Workflow:</strong> MVC, OOP, agile habits, AI-assisted development</p>
                        </div>
                    </div>
                    
                    <!-- Project Akademik Dan Non Akademik Section -->
                    <div class="cv-section">
                        <h2 class="cv-section-title-ats">PROJECT AKADEMIK DAN NON AKADEMIK</h2>
                        <div class="cv-section-line"></div>
                        
                        <div class="cv-item-ats">
                            <div class="cv-item-header">
                                <span class="cv-item-title">Dashboard IoT - Bandul Matematis</span>
                                <span class="cv-item-date">2026</span>
                            </div>
                            <div class="cv-item-subtitle-ats">Fullstack Developer & IoT Engineer | github.com/MuhammadAmirN/Dashboard_IoT</div>
                            <ul class="cv-bullet-list">
                                <li>Membangun dashboard monitoring real-time untuk praktikum fisika berbasis Laravel dan MySQL.</li>
                                <li>Mengintegrasikan visualisasi data sensor dan deployment publik untuk akses mudah.</li>
                            </ul>
                        </div>
                        
                        <div class="cv-item-ats">
                            <div class="cv-item-header">
                                <span class="cv-item-title">Website Laundry Mataram</span>
                                <span class="cv-item-date">2025</span>
                            </div>
                            <div class="cv-item-subtitle-ats">Full Stack Developer | github.com/MuhammadAmirN/website_online_loundry</div>
                            <ul class="cv-bullet-list">
                                <li>Mengembangkan sistem manajemen laundry dengan fitur CRUD dan role-based access.</li>
                                <li>Menyusun modul laporan dan alur transaksi menggunakan Laravel serta MySQL.</li>
                            </ul>
                        </div>

                        <div class="cv-item-ats">
                            <div class="cv-item-header">
                                <span class="cv-item-title">Enkripsi Data</span>
                                <span class="cv-item-date">2025</span>
                            </div>
                            <div class="cv-item-subtitle-ats">Java Developer | github.com/MuhammadAmirN/membuat-enkripsi-data</div>
                            <ul class="cv-bullet-list">
                                <li>Membangun aplikasi simulasi enkripsi data untuk menjaga kerahasiaan informasi.</li>
                                <li>Menerapkan konsep kriptografi dasar untuk proses proteksi data.</li>
                            </ul>
                        </div>

                        <div class="cv-item-ats">
                            <div class="cv-item-header">
                                <span class="cv-item-title">Sistem Pemesanan Laundry</span>
                                <span class="cv-item-date">2024</span>
                            </div>
                            <div class="cv-item-subtitle-ats">Backend Developer | github.com/MuhammadAmirN/pemesanan-loundry</div>
                            <ul class="cv-bullet-list">
                                <li>Membangun sistem pemesanan berbasis Python dengan desain OOP.</li>
                                <li>Mengelola data customer, booking, payment, dan evaluasi layanan.</li>
                            </ul>
                        </div>

                        <div class="cv-item-ats">
                            <div class="cv-item-header">
                                <span class="cv-item-title">Pemesanan Laundry</span>
                                <span class="cv-item-date">2024</span>
                            </div>
                            <div class="cv-item-subtitle-ats">Python Developer | github.com/MuhammadAmirN/pemesanan-loundry</div>
                            <ul class="cv-bullet-list">
                                <li>Mengembangkan aplikasi pemesanan laundry berbasis Python.</li>
                                <li>Mengelola data order, layanan, dan status pengerjaan pelanggan.</li>
                            </ul>
                        </div>

                        <div class="cv-item-ats">
                            <div class="cv-item-header">
                                <span class="cv-item-title">Sistem Kasir Sederhana</span>
                                <span class="cv-item-date">2024</span>
                            </div>
                            <div class="cv-item-subtitle-ats">Fullstack Developer | github.com/MuhammadAmirN/kasir-sederhana</div>
                            <ul class="cv-bullet-list">
                                <li>Mengembangkan aplikasi POS desktop berbasis Java dengan GUI.</li>
                                <li>Mengintegrasikan inventory, transaksi, dan laporan harian.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="cv-section">
                        <h2 class="cv-section-title-ats">RINGKASAN PORTOFOLIO</h2>
                        <div class="cv-section-line"></div>
                        <p class="cv-text" style="margin-bottom: 0;">Portfolio berisi 12 project aktif di GitHub, mencakup web app Laravel, Python API, sistem reservasi, landing page, dan IoT dashboard. Detail project lain tersedia di <strong>amirdev.me</strong>.</p>
                    </div>

                    <!-- Pengalaman & Kontribusi Section -->
                    <div class="cv-section">
                        <h2 class="cv-section-title-ats">PENGALAMAN PRAKTIK & KONTRIBUSI</h2>
                        <div class="cv-section-line"></div>
                        <div class="cv-item-ats">
                            <div class="cv-item-header">
                                <span class="cv-item-title">KKN-T Universitas Duta Bangsa Surakarta (Desa Karangasem)</span>
                                <span class="cv-item-date">Des 2025 - Jan 2026</span>
                            </div>
                            <div class="cv-item-subtitle-ats">Divisi Publikasi, Dokumentasi & Desain | UMKM Digitalization Project</div>
                            <ul class="cv-bullet-list">
                                <li>Merancang materi promosi dan identitas visual program.</li>
                                <li>Mendukung digitalisasi UMKM melalui aset konten dan dokumentasi.</li>
                            </ul>
                        </div>

                        <div class="cv-item-ats">
                            <div class="cv-item-header">
                                <span class="cv-item-title">Internship Readiness Status</span>
                                <span class="cv-item-date">Current</span>
                            </div>
                            <ul class="cv-bullet-list">
                                <li>Siap untuk bekerja fulltime sesuai kebutuhan perusahaan.</li>
                                <li>Memiliki portfolio aktif dengan dokumentasi GitHub.</li>
                                <li>Cepat belajar dan nyaman dengan self-directed learning.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        .cv-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow-y: auto;
            background-color: rgba(0,0,0,0.85);
            backdrop-filter: blur(8px);
            padding: 20px 0;
        }
        .cv-modal-content {
            background-color: #f3f4f6;
            margin: 2% auto;
            padding: 24px;
            border-radius: 12px;
            width: 90%;
            max-width: 900px;
            position: relative;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.3);
        }
        .cv-close-btn {
            color: #4b5563;
            float: right;
            font-size: 32px;
            font-weight: bold;
            cursor: pointer;
            margin-top: -15px;
            transition: color 0.2s;
        }
        .cv-close-btn:hover {
            color: #ef4444;
        }
        
        /* CV Paper Styling - ATS B&W Portrait */
        .cv-paper {
            background: #ffffff;
            color: #000000;
            font-family: 'Times New Roman', Times, serif;
            padding: 40px 50px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border-radius: 4px;
            line-height: 1.4;
            max-width: 100%;
            margin: 0 auto;
            text-align: left;
        }
        
        .cv-body {
            width: 100%;
        }

        .cv-header-section {
            text-align: center;
            margin-bottom: 20px;
        }

        .cv-header-section .cv-name {
            font-size: 24px;
            font-weight: bold;
            color: #000000;
            margin: 0 0 8px 0;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .cv-contact-info, .cv-contact-links {
            font-size: 11px;
            color: #333333;
            margin-bottom: 4px;
        }

        .cv-contact-info span, .cv-contact-links span {
            margin: 0 6px;
        }

        .cv-section {
            margin-top: 18px;
        }

        .cv-section-title-ats {
            font-size: 14px;
            font-weight: bold;
            color: #000000;
            margin: 0 0 2px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .cv-section-line {
            height: 1px;
            background-color: #000000;
            margin-bottom: 8px;
            width: 100%;
        }

        .cv-text {
            font-size: 11px;
            color: #111111;
            margin-bottom: 6px;
            text-align: justify;
            line-height: 1.4;
        }

        .cv-text-muted {
            font-size: 11px;
            color: #333333;
            margin-bottom: 4px;
            line-height: 1.4;
        }

        .cv-item-ats {
            margin-bottom: 12px;
        }

        .cv-item-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 2px;
            color: #000000;
        }

        .cv-item-title {
            font-weight: bold;
        }

        .cv-item-date {
            font-weight: bold;
            font-size: 11px;
        }

        .cv-item-subtitle-ats {
            font-style: italic;
            font-size: 11px;
            color: #222222;
            margin-bottom: 4px;
        }

        .cv-skills-grid {
            font-size: 11px;
            line-height: 1.4;
        }

        .cv-bullet-list {
            list-style-type: disc;
            margin-top: 2px;
            margin-bottom: 6px;
            padding-left: 20px;
        }

        .cv-bullet-list li {
            font-size: 11px;
            color: #111111;
            margin-bottom: 2px;
            line-height: 1.35;
        }

        @media print {
            @page {
                size: A4;
                margin: 8mm;
            }
            body * { visibility: hidden; }
            #cvPreviewModal, .cv-modal-content, .cv-paper, .cv-paper * { visibility: visible; }
            .cv-modal {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                height: auto;
                background-color: transparent !important;
                backdrop-filter: none !important;
                padding: 0 !important;
            }
            .cv-modal-content {
                background-color: transparent !important;
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
                box-shadow: none !important;
                border-radius: 0 !important;
            }
            .cv-paper {
                box-shadow: none !important;
                padding: 0px !important;
                margin: 0 !important;
                width: 100% !important;
                transform: scale(0.82);
                transform-origin: top left;
                width: 122% !important;
                border-radius: 0 !important;
            }
            .cv-close-btn, button, .btn {
                display: none !important;
            }
        }
        @media (max-width: 768px) {
            .cv-paper {
                padding: 20px 25px;
            }
            .cv-item-header {
                flex-direction: column;
                align-items: flex-start;
            }
            .cv-item-date {
                margin-top: 2px;
            }
        }
    </style>
    <script>
        function openCvModal() {
            document.getElementById('cvPreviewModal').style.display = 'block';
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }
        function closeCvModal() {
            document.getElementById('cvPreviewModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }
        window.onclick = function(event) {
            var modal = document.getElementById('cvPreviewModal');
            if (event.target == modal) {
                closeCvModal();
            }
        }
    </script>
@endsection
