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
                    <img src="{{ asset('images/avatar.png') }}" alt="Muhammad Amir Nurudin" class="hero-avatar">
                    <h3 class="hero-avatar-name">Amir Nurudin</h3>
                    <p class="hero-avatar-title">Fullstack Developer • AI Power-User</p>
                    <div class="hero-socials">
                        <a href="https://github.com/MuhammadAmirN" target="_blank" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
                        <a href="https://linkedin.com" target="_blank" aria-label="LinkedIn"><i class="fa-brands fa-linkedin"></i></a>
                        <a href="mailto:Muhamir6@gmail.com" aria-label="Email"><i class="fa-solid fa-envelope"></i></a>
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
                            @if($project->featured)
                                <span class="project-featured-tag">Utama</span>
                            @endif
                            
                            <div class="project-img-wrapper">
                                @if($project->image_path)
                                    @php
                                        $imageSrc = str_starts_with($project->image_path, 'images/') 
                                            ? asset($project->image_path) 
                                            : asset('storage/' . $project->image_path);
                                    @endphp
                                    <img src="{{ $imageSrc }}" alt="{{ $project->title }}" class="project-img" loading="lazy">
                                @else
                                    <div style="display:flex;align-items:center;justify-content:center;height:100%;color:var(--text-muted);">
                                        <i class="fa-solid fa-image fa-3x"></i>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="project-content">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                    <h3 class="project-title" style="margin-bottom: 0;">{{ $project->title }}</h3>
                                    <span class="project-tag" style="background: rgba(99, 102, 241, 0.1); color: #818cf8; border: 1px solid rgba(99, 102, 241, 0.2); font-weight: bold;">
                                        Peran: Fullstack
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
                                        <a href="{{ $project->github_url }}" target="_blank" class="project-link">
                                            <i class="fa-brands fa-github"></i> Kode Sumber
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
                                <p>muhamirn6@gmail.com</p>
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
                        <a href="https://linkedin.com" target="_blank" aria-label="LinkedIn"><i class="fa-brands fa-linkedin"></i></a>
                        <a href="mailto:Muhamir6@gmail.com" aria-label="Email"><i class="fa-solid fa-envelope"></i></a>
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
                <!-- Left Sidebar -->
                <div class="cv-left">
                    <div class="cv-avatar-wrapper">
                        <img src="{{ asset('images/avatar.png') }}" alt="Muhammad Amir Nurudin">
                    </div>
                    
                    <div class="cv-section-title">KONTAK</div>
                    <div class="cv-contact-item"><strong>WhatsApp</strong><br>+62 821-4515-3914</div>
                    <div class="cv-contact-item"><strong>Email</strong><br>Muhamir6@gmail.com</div>
                    <div class="cv-contact-item"><strong>Github</strong><br>https://github.com/MuhammadAmirN</div>
                    <div class="cv-contact-item"><strong>Lokasi</strong><br>Klaten, Jawa Tengah</div>
                    
                    <div class="cv-section-title" style="margin-top: 1.5rem;">KEAHLIAN</div>
                    <ul class="cv-skills-list">
                        <li>PHP/Laravel</li>
                        <li>MySQL</li>
                        <li>Python</li>
                        <li>HTML/CSS/JS</li>
                        <li>Canva/Figma Design</li>
                        <li>Git/Github</li>
                        <li>Teamwork</li>
                        <li>IoT Simulation (Wokwi)</li>
                    </ul>
                </div>
                
                <!-- Right Main -->
                <div class="cv-right">
                    <h1 class="cv-name">MUHAMMAD AMIR<br>NURUDIN</h1>
                    
                    <h2 class="cv-header-dark">TENTANG SAYA</h2>
                    <p class="cv-text">Mahasiswa semester 6 Teknik Informatika di Universitas Duta Bangsa Surakarta dengan penjurusan Internet of Things (IoT). Memiliki pengalaman dalam pengembangan aplikasi web menggunakan framework Laravel serta simulasi sistem hardware menggunakan Wokwi di semester ini.</p>
                    
                    <h2 class="cv-header-dark">PENGALAMAN</h2>
                    <div class="cv-item">
                        <div class="cv-item-title">KKN-T UDB Surakarta (Desa Karangasem)</div>
                        <div class="cv-item-subtitle">Divisi Publikasi & Dokumentasi / Des 2025 - Jan 2026</div>
                        <p class="cv-text">Bertanggung jawab dalam desain identitas program (logo dan banner) serta melakukan digitalisasi data UMKM keripik singkong melalui pembuatan konten dan packaging.</p>
                    </div>
                    
                    <h2 class="cv-header-dark">PENDIDIKAN</h2>
                    <div class="cv-item">
                        <div class="cv-item-title">Universitas Duta Bangsa Surakarta</div>
                        <div class="cv-item-subtitle">S1 Teknik Informatika / 2023 - Sekarang</div>
                        <div class="cv-item-subtitle" style="font-weight:bold; color:#000;">IPK Terakhir : 4.00</div>
                    </div>
                    
                    <h2 class="cv-header-dark">PROYEK IT</h2>
                    <div class="cv-item">
                        <div class="cv-item-title">Sistem Order Management (Web-based)</div>
                        <div class="cv-item-subtitle">Laravel framework, MySQL</div>
                        <p class="cv-text">Membangun aplikasi self-service untuk user dalam melakukan pemesanan dan dashboard admin bagi kasir untuk mengelola transaksi secara efisien dan untuk user offline, dan masi dalam perkembangan role management untuk memantau laporan keuangan.</p>
                    </div>
                    <div class="cv-item">
                        <div class="cv-item-title">Simulasi Sistem Monitoring Sensor (Wokwi).</div>
                        <p class="cv-text">Merancang simulasi sistem input-output pada ESP32 menggunakan LED, Push Button, Potensiometer, dan LCD I2C 16x2 melalui platform Wokwi untuk memahami logika kendali hardware secara real-time.</p>
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
            background-color: rgba(0,0,0,0.8);
            backdrop-filter: blur(5px);
            padding-bottom: 50px;
        }
        .cv-modal-content {
            background-color: #f0f2f5;
            margin: 5% auto;
            padding: 20px;
            border-radius: 12px;
            width: 90%;
            max-width: 850px;
            position: relative;
        }
        .cv-close-btn {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            margin-top: -10px;
        }
        .cv-close-btn:hover {
            color: #000;
        }
        
        /* CV Paper Styling */
        .cv-paper {
            display: flex;
            background: #fff;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            color: #333;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            border-radius: 4px;
            overflow: hidden;
            text-align: left;
        }
        .cv-left {
            width: 35%;
            background-color: #1a2538;
            color: #fff;
            padding: 2rem 1.5rem;
        }
        .cv-right {
            width: 65%;
            background-color: #f8f9fa;
            padding: 2rem 2.5rem;
        }
        .cv-avatar-wrapper {
            text-align: center;
            margin-bottom: 2rem;
        }
        .cv-avatar-wrapper img {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background-color: #ff3333;
            border: 3px solid #1a2538;
            box-shadow: 0 0 0 3px #fff;
            object-fit: cover;
        }
        .cv-section-title {
            background: #fff;
            color: #1a2538;
            text-align: center;
            padding: 0.4rem;
            font-weight: bold;
            border-radius: 20px;
            margin-bottom: 1.2rem;
            letter-spacing: 1px;
            font-size: 0.95rem;
        }
        .cv-contact-item {
            margin-bottom: 1rem;
            font-size: 0.85rem;
            line-height: 1.4;
        }
        .cv-contact-item strong {
            font-size: 0.9rem;
        }
        .cv-skills-list {
            list-style: none;
            padding: 0;
            font-size: 0.9rem;
            font-weight: bold;
            margin-left: 0;
        }
        .cv-skills-list li {
            margin-bottom: 0.8rem;
        }
        .cv-name {
            color: #1a2538;
            font-size: 2.2rem;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            font-weight: 800;
        }
        .cv-header-dark {
            background-color: #0b1a30;
            color: #fff;
            padding: 0.3rem 1rem;
            font-size: 1.1rem;
            margin-bottom: 0.8rem;
            display: inline-block;
            margin-top: 1rem;
            text-transform: uppercase;
        }
        .cv-text {
            font-size: 0.9rem;
            line-height: 1.5;
            color: #444;
            margin-bottom: 1rem;
            text-align: justify;
        }
        .cv-item {
            margin-bottom: 1.2rem;
        }
        .cv-item-title {
            font-weight: bold;
            color: #1a2538;
            font-size: 1rem;
        }
        .cv-item-subtitle {
            font-style: italic;
            font-size: 0.85rem;
            color: #555;
            margin-bottom: 0.4rem;
        }
        
        @media print {
            body * { visibility: hidden; }
            .cv-paper, .cv-paper * { visibility: visible; }
            .cv-paper {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                box-shadow: none;
            }
        }
        @media (max-width: 768px) {
            .cv-paper {
                flex-direction: column;
            }
            .cv-left, .cv-right {
                width: 100%;
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
