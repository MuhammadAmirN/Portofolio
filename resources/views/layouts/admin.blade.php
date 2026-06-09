<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panel Admin | Portofolio</title>
    
    <!-- FontAwesome & Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Vite CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-logo logo">
                Admin<span>Panel</span>
            </div>
            
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link @if(Route::is('admin.dashboard')) active @endif">
                        <i class="fa-solid fa-chart-pie"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.skills.index') }}" class="sidebar-link @if(Route::is('admin.skills.*')) active @endif">
                        <i class="fa-solid fa-server"></i> Keahlian
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.projects.index') }}" class="sidebar-link @if(Route::is('admin.projects.*')) active @endif">
                        <i class="fa-solid fa-laptop-code"></i> Proyek
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.messages.index') }}" class="sidebar-link @if(Route::is('admin.messages.*')) active @endif">
                        <i class="fa-solid fa-envelope"></i> Inbox
                        @php
                            $unreadCount = \App\Models\Message::where('status', 'unread')->count();
                        @endphp
                        @if($unreadCount > 0)
                            <span class="status-badge badge-unread" style="margin-left: auto; border-radius: 10px; padding: 0.1rem 0.5rem; font-size: 0.7rem;">{{ $unreadCount }}</span>
                        @endif
                    </a>
                </li>
                <li style="margin-top: 2rem; border-top: 1px solid var(--border-color); padding-top: 1rem;">
                    <a href="{{ route('portfolio.index') }}" class="sidebar-link">
                        <i class="fa-solid fa-globe"></i> Lihat Website
                    </a>
                </li>
            </ul>
            
            <div class="sidebar-footer">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fa-solid fa-right-from-bracket"></i> Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="admin-main">
            <!-- Toast Feedback -->
            @if(session('success'))
                <div class="alert alert-success" style="margin-bottom: 2rem;">
                    <i class="fa-solid fa-circle-check" style="margin-right: 0.5rem;"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger" style="margin-bottom: 2rem;">
                    <i class="fa-solid fa-circle-xmark" style="margin-right: 0.5rem;"></i> {{ session('error') }}
                </div>
            @endif

            @yield('admin_content')
        </main>
    </div>

    @yield('admin_scripts')
</body>
</html>
