@extends('layouts.app')

@section('content')

    <!-- Hero Section -->
    <section id="home" class="section hero" style="padding-top: 2rem;">
        <div class="container hero-inner">
            <div class="hero-content">
                <span class="hero-tag">IT Student & Web Developer</span>
                <h1 class="hero-title">
                    Membangun Pengalaman Web yang <span>Estetis</span> & <span>Interaktif</span>
                </h1>
                <p class="hero-desc">
                    Saya adalah mahasiswa Teknologi Informasi yang senang membangun aplikasi web dari frontend hingga backend. Saya tertarik pada pengembangan produk digital modern, mengeksplorasi teknologi baru, dan memanfaatkan AI untuk membantu menciptakan solusi yang lebih efektif dan bermanfaat.
                </p>
                <div class="hero-actions">
                    <a href="#contact" class="btn btn-primary">Hubungi Saya</a>
                    <a href="#projects" class="btn btn-secondary">Eksplorasi Karya</a>
                </div>
            </div>
            
            <div class="hero-illustration">
                <div class="hero-img-glow"></div>
                <div class="hero-avatar-card glass-card">
                    <img src="{{ asset('images/avatar.png') }}" alt="Muhammad Amir Nurudin" class="hero-avatar">
                    <h3 class="hero-avatar-name">Amir Nurudin</h3>
                    <p class="hero-avatar-title">Frontend Enthusiast • IT Student</p>
                    <div class="hero-socials">
                        <a href="https://github.com/muhamirudin" target="_blank" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
                        <a href="https://linkedin.com" target="_blank" aria-label="LinkedIn"><i class="fa-brands fa-linkedin"></i></a>
                        <a href="#" target="_blank" aria-label="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section about">
        <div class="container">
            <div class="section-header">
                <span class="section-subtitle">Tentang Saya</span>
                <h2 class="section-title">Fokus pada Tampilan & Pengalaman</h2>
            </div>
            
            <div class="about-grid">
                <div class="about-text">
                    <p>
                        Sebagai mahasiswa jurusan IT di <strong>Universitas Duta Bangsa Surakarta</strong> (Angkatan 2023) yang kini berada di semester 6 (persiapan magang semester 7), saya selalu antusias mempelajari teknologi web terbaru.
                    </p>
                    <p>
                        Fokus utama saya adalah <strong>Frontend Development</strong>. Saya sangat menyukai proses merancang tampilan (UI) yang memanjakan mata dan memberikan pengalaman (UX) yang nyaman bagi pengguna. Meski begitu, saya juga mengembangkan porsi backend secukupnya agar aplikasi web dapat berjalan sempurna secara keseluruhan.
                    </p>
                    <div style="margin-top: 2rem;">
                        <a href="#projects" class="btn btn-secondary"><i class="fa-solid fa-code" style="margin-right: 0.5rem;"></i>Lihat Karya Saya</a>
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
                        <div class="stat-number">10+</div>
                        <div class="stat-label">Proyek GitHub</div>
                    </div>
                    <div class="stat-card glass-card">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">Fokus Kualitas</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="section skills">
        <div class="container">
            <div class="section-header">
                <span class="section-subtitle">Keahlian</span>
                <h2 class="section-title">Teknologi yang Saya Kuasai</h2>
            </div>
            
            <div class="skills-grid">
                @foreach($skills as $category => $items)
                    <div class="skills-category glass-card">
                        <h3 class="skills-category-title">
                            @if($category === 'Backend Development')
                                <i class="fa-solid fa-server"></i>
                            @elseif($category === 'Frontend Development')
                                <i class="fa-solid fa-laptop-code"></i>
                            @else
                                <i class="fa-solid fa-screwdriver-wrench"></i>
                            @endif
                            {{ $category }}
                        </h3>
                        <div class="skills-list">
                            @foreach($items as $skill)
                                <div class="skill-item">
                                    <div class="skill-header">
                                        <span class="skill-name">
                                            <i class="{{ $skill->icon ?: 'fa-solid fa-circle-nodes' }}"></i>
                                            {{ $skill->name }}
                                        </span>
                                        <span class="skill-level">{{ $skill->level }}%</span>
                                    </div>
                                    <div class="skill-bar">
                                        <div class="skill-progress" data-level="{{ $skill->level }}"></div>
                                    </div>
                                    @if($skill->description)
                                        <p class="skill-desc">{{ $skill->description }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
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
                                    <span class="project-tag" style="background: rgba(99, 102, 241, 0.1); color: #818cf8; border: 1px solid rgba(99, 102, 241, 0.2);">
                                        {{ $project->contribution_percentage }}% Effort
                                    </span>
                                </div>
                                <p class="project-desc">{{ $project->description }}</p>
                                
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
                        Apakah Anda memiliki proyek menarik, tawaran pekerjaan, atau hanya ingin menyapa? Silakan kirimkan pesan, saya akan merespons secepat mungkin.
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
                        <a href="https://github.com" target="_blank" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
                        <a href="https://linkedin.com" target="_blank" aria-label="LinkedIn"><i class="fa-brands fa-linkedin"></i></a>
                        <a href="https://twitter.com" target="_blank" aria-label="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
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
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Judul pesan Anda" value="{{ old('subject') }}">
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

@endsection
