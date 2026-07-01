@extends('layouts.app')

@section('content')

    <!-- Hero Section -->
    <section id="home" class="section hero" style="padding-top: 2rem;">
        <div class="container hero-inner">
            <div class="hero-content">
                <span class="hero-tag">Fullstack Web Developer | Frontend Developer</span>
                <h1 class="hero-title">
                    Hi, I'm <span>Muhammad Amir Nurudin</span>.
                </h1>
                <p class="hero-desc">
                    Mahasiswa Teknik Informatika semester 6 yang berfokus pada pengembangan aplikasi web <em>full-stack</em> menggunakan Laravel, Node.js, dan teknologi modern. Senang mempelajari hal baru, membangun aplikasi yang mudah digunakan, serta memanfaatkan AI sebagai alat bantu untuk meningkatkan produktivitas dalam proses pengembangan.
                </p>
                <div class="hero-actions">
                    <a href="#projects" class="btn btn-primary">Lihat Proyek</a>
                    <a href="{{ asset('images/projects/CV-Amir.pdf') }}" class="btn btn-secondary" target="_blank">
                        <i class="fa-solid fa-download" style="margin-right: 0.5rem;"></i>Download CV</a>
                </div>
            </div>
            
            <div class="hero-illustration">
                <div class="hero-img-glow"></div>
                <div class="hero-avatar-card glass-card">
                    <img src="{{ asset('images/avatar.jpg') }}" alt="Muhammad Amir Nurudin" class="hero-avatar">
                    <h3 class="hero-avatar-name">Amir Nurudin</h3>
                    <p class="hero-avatar-title">Fullstack & Frontend Developer</p>
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
            <div class="section-header projects-intro">
                <div class="projects-intro-copy">
                    <span class="section-subtitle">Portofolio</span>
                    <h2 class="section-title">Proyek yang Saya Bangun</h2>
                    <p class="projects-lead">
                        Dari dashboard IoT hingga bot WhatsApp — setiap proyek menyelesaikan masalah nyata dengan stack yang berbeda.
                    </p>
                </div>
                <div class="projects-stats glass-card">
                    <div class="projects-stat">
                        <span class="projects-stat-number">{{ count($projects) }}</span>
                        <span class="projects-stat-label">Total Proyek</span>
                    </div>
                    <div class="projects-stat">
                        <span class="projects-stat-number">{{ collect($projects)->filter(fn ($project) => (bool) data_get($project, 'featured', false))->count() }}</span>
                        <span class="projects-stat-label">Unggulan</span>
                    </div>
                </div>
            </div>

            @php
                $projectImageMap = [
                    'Dashboard IoT' => 'images/projects/IoT.png',
                    'Website Laundry Mataram' => 'images/projects/Loundry_mataram.png',
                    'Enkripsi Data' => 'images/projects/membuat-enkripsi-data.png',
                    'Pemesanan Tiket Bola' => 'images/projects/pemesanan_tiket_bola.png',
                    'Pemesanan Laundry' => 'images/projects/pemesanan-loundry_py.png',
                    'Membuat Navigasi' => 'images/projects/Navigasi_flutter.png',
                    'Reservasi Cafe' => 'images/projects/reservasi_cafe.png',
                    'Manajemen Data Mahasiswa' => 'images/projects/data-mhs.png',
                    'Portofolio Website' => 'images/projects/portfolio.png',
                    'Sistem Kasir Sederhana' => 'images/projects/kasir_java.png',
                    'Review System' => 'images/projects/penilaian-pada-e-commerce.png',
                ];

                $projectImageAliases = [
                    'Dashboard IoT' => [
                        'images/projects/image.png',
                        'images/projects/iot.png',
                        'images/projects/IoT.png',
                    ],
                ];

                $resolveProjectImage = function ($project) use ($projectImageMap, $projectImageAliases) {
                    $title = data_get($project, 'title');
                    $candidates = array_values(array_filter([
                        data_get($project, 'image_path'),
                        $projectImageMap[$title] ?? null,
                    ]));
                    $candidates = array_values(array_unique(array_merge(
                        $candidates,
                        $projectImageAliases[$title] ?? []
                    )));

                    foreach ($candidates as $path) {
                        if (file_exists(public_path($path))) {
                            return asset($path);
                        }

                        $lowerPath = strtolower($path);
                        if ($lowerPath !== $path && file_exists(public_path($lowerPath))) {
                            return asset($lowerPath);
                        }
                    }

                    $fallback = $candidates[0] ?? null;

                    if (!$fallback) {
                        return null;
                    }

                    return str_starts_with($fallback, 'images/')
                        ? asset($fallback)
                        : asset('storage/' . $fallback);
                };

                $featuredProjects = collect($projects)->filter(fn ($project) => (bool) data_get($project, 'featured', false))->values();
                $otherProjects = collect($projects)->filter(fn ($project) => ! (bool) data_get($project, 'featured', false))->values();
                $heroProject = $featuredProjects->first(fn ($project) => data_get($project, 'title') === 'Dashboard IoT') ?? $featuredProjects->first();
                $featuredGrid = $featuredProjects->reject(fn ($project) => data_get($project, 'title') === data_get($heroProject, 'title'))->values();
            @endphp

            @if($heroProject)
                @php
                    $heroTitle = data_get($heroProject, 'title');
                    $heroGithubUrl = data_get($heroProject, 'github_url');
                    $heroProjectUrl = data_get($heroProject, 'project_url');
                    $heroImageSrc = $resolveProjectImage($heroProject);
                @endphp
                <article class="project-spotlight project-reveal">
                    <div class="project-spotlight-media">
                        @if($heroImageSrc)
                            <img src="{{ $heroImageSrc }}" alt="{{ $heroTitle }}" class="project-spotlight-img" loading="lazy">
                        @else
                            <div class="project-spotlight-placeholder">
                                <i class="fa-solid fa-microchip"></i>
                            </div>
                        @endif
                        <div class="project-spotlight-overlay"></div>
                    </div>
                    <div class="project-spotlight-body glass-card">
                        <span class="project-eyebrow"><i class="fa-solid fa-star"></i> Proyek Unggulan</span>
                        <h3 class="project-spotlight-title">{{ $heroTitle }}</h3>
                        <p class="project-spotlight-role">{{ data_get($heroProject, 'role') }}</p>
                        <p class="project-spotlight-desc">{{ data_get($heroProject, 'description') }}</p>
                        @if($heroTech = data_get($heroProject, 'tech_stack', []))
                            <div class="project-tech-row">
                                @foreach($heroTech as $tech)
                                    <span class="project-tech-pill">{{ $tech }}</span>
                                @endforeach
                            </div>
                        @endif
                        <div class="project-spotlight-actions">
                            @if($heroProjectUrl)
                                <a href="{{ $heroProjectUrl }}" target="_blank" rel="noreferrer" class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i> Live Demo
                                </a>
                            @endif
                            @if($heroGithubUrl)
                                <a href="{{ $heroGithubUrl }}" target="_blank" rel="noreferrer" class="btn btn-secondary btn-sm">
                                    <i class="fa-brands fa-github"></i> Source Code
                                </a>
                            @endif
                        </div>
                    </div>
                </article>
            @endif

            @if($featuredGrid->isNotEmpty())
                <div class="projects-featured-grid">
                    @foreach($featuredGrid as $index => $project)
                        @php
                            $title = data_get($project, 'title');
                            $githubUrl = data_get($project, 'github_url');
                            $projectUrl = data_get($project, 'project_url');
                            $imageSrc = $resolveProjectImage($project);
                            $techStack = data_get($project, 'tech_stack', []);
                        @endphp
                        <article class="project-card project-card--featured project-reveal" style="--reveal-delay: {{ $index * 0.08 }}s">
                            <a href="{{ $githubUrl }}" target="_blank" rel="noreferrer" class="project-card-hit" aria-label="Lihat {{ $title }} di GitHub">
                                <div class="project-img-wrapper">
                                    <div class="project-img-frame">
                                    @if($imageSrc)
                                        <img src="{{ $imageSrc }}" alt="{{ $title }}" class="project-img" loading="lazy">
                                    @else
                                        <div class="project-img-placeholder"><i class="fa-solid fa-code"></i></div>
                                    @endif
                                    <div class="project-img-overlay">
                                        <span class="project-overlay-cta"><i class="fa-brands fa-github"></i> Lihat Repo</span>
                                    </div>
                                 </div>
                                </div>
                                <div class="project-content">
                                    <span class="project-eyebrow">Featured</span>
                                    <h3 class="project-title">{{ $title }}</h3>
                                    <p class="project-role">{{ data_get($project, 'role') }}</p>
                                    <p class="project-desc">{{ data_get($project, 'description') }}</p>
                                    @if($techStack)
                                        <div class="project-tech-row">
                                            @foreach(array_slice($techStack, 0, 3) as $tech)
                                                <span class="project-tech-pill">{{ $tech }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </a>
                            @if($projectUrl)
                                <a href="{{ $projectUrl }}" target="_blank" rel="noreferrer" class="project-link project-link--inline">
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i> Demo
                                </a>
                            @endif
                        </article>
                    @endforeach
                </div>
            @endif

            @if($otherProjects->isNotEmpty())
                <div class="projects-more-header project-reveal">
                    <h3 class="projects-more-title">Proyek Lainnya</h3>
                    <p class="projects-more-desc">Eksplorasi lebih lanjut di berbagai bahasa dan platform.</p>
                </div>
                <div class="projects-compact-list">
                    @foreach($otherProjects as $index => $project)
                        @php
                            $title = data_get($project, 'title');
                            $githubUrl = data_get($project, 'github_url');
                            $imageSrc = $resolveProjectImage($project);
                            $techStack = data_get($project, 'tech_stack', []);
                        @endphp
                        <article class="project-compact project-reveal" style="--reveal-delay: {{ $index * 0.06 }}s">
                            <a href="{{ $githubUrl }}" target="_blank" rel="noreferrer" class="project-compact-thumb" aria-hidden="true" tabindex="-1">
                                @if($imageSrc)
                                    <img src="{{ $imageSrc }}" alt="" loading="lazy">
                                @else
                                    <span class="project-compact-icon"><i class="fa-solid fa-folder-open"></i></span>
                                @endif
                            </a>
                            <div class="project-compact-body">
                                <div class="project-compact-top">
                                    <h4 class="project-compact-title">
                                        <a href="{{ $githubUrl }}" target="_blank" rel="noreferrer">{{ $title }}</a>
                                    </h4>
                                    <span class="project-compact-role">{{ data_get($project, 'role') }}</span>
                                </div>
                                <p class="project-compact-desc">{{ data_get($project, 'description') }}</p>
                                @if($techStack)
                                    <div class="project-tech-row project-tech-row--compact">
                                        @foreach(array_slice($techStack, 0, 4) as $tech)
                                            <span class="project-tech-pill">{{ $tech }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <a href="{{ $githubUrl }}" target="_blank" rel="noreferrer" class="project-compact-arrow" aria-label="Buka {{ $title }}">
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </article>
                    @endforeach
                </div>
            @endif
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

    <!-- education & experience section -->

<section class="journey-section">
    <div class="container">
        <span class="sub-title">MY JOURNEY</span>
        <h2 class="section-title">Experience, Education & <span>Certification</span></h2>

        <div class="journey-grid">
            <div class="journey-column">
                <h3 class="column-title"><span class="dot-icon purple"></span>Education</h3>
                <div class="timeline-wrapper">
                    <div class="timeline-item">
                        <span class="timeline-badge badge-purple">2023 – Sekarang</span>
                        <h4 class="item-title">S1 Teknik Informatika</h4>
                        <span class="item-company">Universitas Duta Bangsa Surakarta</span>
                        <p class="item-desc"> Mempelajari berbagai teknologi dalam pengembangan perangkat lunak, termasuk fullstack web development, IoT, dan pengembangan berbasis AI tools. Berpengalaman membangun aplikasi dengan Laravel, Python, Java, dan Node.js dari desain database sampai antarmuka </p>
                    </div>
                    <div class="timeline-item">
                        <span class="timeline-badge badge-purple">2019 – 2022</span>
                        <h4 class="item-title">IPA</h4>
                        <span class="item-company">Madrasah Aliyah Negeri Kupang (NTT)</span>
                        <p class="item-desc">Mempelajari berbagai mata pelajaran ilmu pengetahuan alam, logika matematika, serta aktif dalam kegiatan pengembangan bahasa.</p>
                    </div>
                </div>
            </div>

            <div class="journey-column">
                <h3 class="column-title"><span class="dot-icon blue"></span>Certification</h3>
                <div class="timeline-wrapper">
                    <div class="timeline-item">
                        <span class="timeline-badge badge-blue">2024</span>
                        <h4 class="item-title">Entrepreneur Summit Singapore and Malaysia</h4>
                        <span class="item-company">Universitas Duta Bangsa Surakarta</span>
                        <p class="item-desc">Menguasai framework python untuk mengoptimalkan startup dan mengetahui AI/Artificial Intelligence Assist.</p>
                    </div>
                    <div class="timeline-item">
                        <span class="timeline-badge badge-blue">Desember 2023</span>
                        <h4 class="item-title">Public Speaking dalam acara YEF23</h4>
                        <span class="item-company">Universitas Duta Bangsa Surakarta</span>
                        <p class="item-desc">Mengembangkan kapabilitas komunikasi publik dan memahami penyampaian gagasan solutif pada acara tersebut.</p>
                    </div> 
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
                    <div class="contact-direct">
                        <h3 style="font-size: 1.5rem; margin-bottom: 1rem;">Langsung ke inbox saya</h3>
                        <p style="color: var(--text-secondary); margin-bottom: 1.5rem;">
                            Karena halaman ini dibuat statis, silakan hubungi saya lewat email atau LinkedIn tanpa form database.
                        </p>
                        <div style="display: flex; flex-wrap: wrap; gap: 0.75rem;">
                            <a href="mailto:muhamir6n@gmail.com" class="btn btn-primary">
                                <i class="fa-solid fa-envelope"></i> Email Saya
                            </a>
                            <a href="https://linkedin.com/in/muh-amir-n-a1a94b418/" target="_blank" rel="noreferrer" class="btn btn-secondary">
                                <i class="fa-brands fa-linkedin"></i> LinkedIn
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @php $cvPdfUrl = asset('images/projects/CV-Amir.pdf'); @endphp

    <!-- CV Modal -->
    <div id="cvPreviewModal" class="cv-modal" aria-hidden="true">
        <div class="cv-modal-content" role="dialog" aria-labelledby="cvModalTitle">
            <div class="cv-modal-header">
                <h3 id="cvModalTitle">Curriculum Vitae</h3>
                <div class="cv-modal-actions">
                    <a href="{{ $cvPdfUrl }}" download="CV-Amir.pdf" class="btn btn-primary btn-sm">
                        <i class="fa-solid fa-download" style="margin-right: 0.4rem;"></i>Download PDF
                    </a>
                    <button type="button" class="cv-close-btn" onclick="closeCvModal()" aria-label="Tutup">&times;</button>
                </div>
            </div>
            <iframe src="{{ $cvPdfUrl }}" type="application/pdf" class="cv-pdf-frame" style="width : 100%; height: 70vh;" title="CV Muhammad Amir Nurudin">
                <p>Browser Anda tidak mendukung tampilan PDF. Silakan download CV untuk melihatnya. <a href="{{ $cvPdfUrl }}"> Download CV</a>.</p>
            </iframe>
        </div>
    </div>

    <style>
        .cv-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(8px);
            padding: 1.25rem;
        }
        .cv-modal-content {
            background-color: #111827;
            margin: 0 auto;
            padding: 1.25rem;
            border-radius: 12px;
            width: 100%;
            max-width: 920px;
            height: calc(100vh - 2.5rem);
            display: flex;
            flex-direction: column;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3);
        }
        .cv-modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1rem;
            flex-shrink: 0;
        }
        .cv-modal-header h3 {
            margin: 0;
            font-size: 1.1rem;
            color: #f9fafb;
        }
        .cv-modal-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .cv-close-btn {
            background: none;
            border: none;
            color: #9ca3af;
            font-size: 2rem;
            line-height: 1;
            cursor: pointer;
            padding: 0;
        }
        .cv-close-btn:hover {
            color: #ef4444;
        }
        .cv-pdf-frame {
            flex: 1;
            width: 100%;
            border: none;
            border-radius: 8px;
            background: #fff;
        }
        @media (max-width: 768px) {
            .cv-modal {
                padding: 0.75rem;
            }
            .cv-modal-content {
                height: calc(100vh - 1.5rem);
                padding: 1rem;
            }
            .cv-modal-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
    <script>
        function openCvModal() {
            document.getElementById('cvPreviewModal').style.display = 'block';
            document.getElementById('cvPreviewModal').setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        }
        function closeCvModal() {
            document.getElementById('cvPreviewModal').style.display = 'none';
            document.getElementById('cvPreviewModal').setAttribute('aria-hidden', 'true');
            document.body.style.overflow = 'auto';
        }
        window.addEventListener('click', function(event) {
            var modal = document.getElementById('cvPreviewModal');
            if (event.target === modal) {
                closeCvModal();
            }
        });
    </script>
@endsection
