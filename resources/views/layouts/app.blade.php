<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Portofolio Profesional | Muhammad Amir Nurudin</title>
    
    <!-- Meta SEO -->
    <meta name="description" content="Portofolio resmi Muhammad Amir Nurudin - Front-end Oriented Web Developer. Menampilkan keahlian frontend, backend, database, dan proyek web.">
    <meta name="keywords" content="Web Developer, Frontend Developer, Laravel, PHP, Portofolio, Muhammad Amir Nurudin">
    
    <!-- FontAwesome & Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Vite CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <!-- Header / Navbar -->
    <nav class="navbar" id="navbar">
        <div class="container navbar-inner">
            <a href="#home" class="logo">
                Amir<span style="color: var(--text-primary);">.dev</span>
            </a>
            <ul class="nav-links">
                <li><a href="#home" class="nav-link active">Beranda</a></li>
                <li><a href="#about" class="nav-link">Tentang</a></li>
                <li><a href="#skills" class="nav-link">Keahlian</a></li>
                <li><a href="#projects" class="nav-link">Proyek</a></li>
                <li><a href="#contact" class="nav-link">Kontak</a></li>
                <li>
                    <a href="{{ route('login') }}" class="btn btn-secondary btn-sm" style="margin-left: 1rem;">
                        <i class="fa-solid fa-lock" style="font-size: 0.8rem; margin-right: 0.4rem;"></i>Admin
                    </a>
                </li>
            </ul>
            <button class="mobile-nav-toggle" id="mobile-toggle" aria-label="Toggle Menu">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <span class="footer-logo logo">Amir<span>.dev</span></span>
            <p class="footer-text">© {{ date('Y') }} Muhammad Amir Nurudin. All rights reserved. Crafted with Laravel.</p>
        </div>
    </footer>

    <!-- Mobile Navigation Menu Overlay Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggle = document.getElementById('mobile-toggle');
            const nav = document.querySelector('.nav-links');
            
            if (toggle && nav) {
                toggle.addEventListener('click', () => {
                    const isOpen = nav.style.display === 'flex';
                    if (isOpen) {
                        nav.style.display = 'none';
                        toggle.innerHTML = '<i class="fa-solid fa-bars"></i>';
                    } else {
                        nav.style.display = 'flex';
                        nav.style.flexDirection = 'column';
                        nav.style.position = 'absolute';
                        nav.style.top = '70px';
                        nav.style.left = '0';
                        nav.style.width = '100%';
                        nav.style.background = '#0a0e17';
                        nav.style.padding = '1.5rem';
                        nav.style.borderBottom = '1px solid var(--border-color)';
                        nav.style.gap = '1.5rem';
                        toggle.innerHTML = '<i class="fa-solid fa-xmark"></i>';
                    }
                });

                // Close menu when clicking nav link
                const links = document.querySelectorAll('.nav-link');
                links.forEach(link => {
                    link.addEventListener('click', () => {
                        if (window.innerWidth <= 1024) {
                            nav.style.display = 'none';
                            toggle.innerHTML = '<i class="fa-solid fa-bars"></i>';
                        }
                    });
                });
            }
        });
    </script>
</body>
</html>
