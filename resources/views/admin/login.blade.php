<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Masuk Admin | Portofolio</title>
    
    <!-- FontAwesome & Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Vite CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-login-body">

    <div class="login-card glass-card">
        <div class="login-header">
            <h1 class="login-logo">Admin<span>Panel</span></h1>
            <p class="login-subtitle">Masuk untuk mengelola portofolio Anda</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fa-solid fa-circle-xmark" style="margin-right: 0.5rem;"></i> {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="email" class="form-label">Alamat Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="admin@portfolio.com" value="{{ old('email') }}" required autofocus>
            </div>
            
            <div class="form-group">
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
            </div>

            <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem; margin-top: 1rem; margin-bottom: 2rem;">
                <input type="checkbox" name="remember" id="remember" style="cursor: pointer;">
                <label for="remember" class="form-label" style="margin-bottom: 0; cursor: pointer; font-size: 0.85rem;">Ingat Saya</label>
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%;">
                <i class="fa-solid fa-right-to-bracket" style="margin-right: 0.5rem;"></i>Masuk
            </button>
        </form>
        
        <div style="text-align: center; margin-top: 2rem;">
            <a href="{{ route('portfolio.index') }}" style="font-size: 0.85rem; color: var(--text-secondary); text-decoration: underline;">
                <i class="fa-solid fa-arrow-left" style="font-size: 0.75rem; margin-right: 0.4rem;"></i>Kembali ke Website
            </a>
        </div>
    </div>

</body>
</html>
