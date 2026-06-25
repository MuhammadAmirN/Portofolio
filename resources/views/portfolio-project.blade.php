@extends('layouts.app')

@section('content')
    <section class="section" style="padding-top: 6rem;">
        <div class="container">
            <div class="section-header" style="text-align: left; margin-bottom: 2rem;">
                <span class="section-subtitle">Detail Project</span>
                <h1 class="section-title" style="margin-bottom: 0.75rem;">{{ $project->title }}</h1>
                <p class="hero-desc" style="max-width: 900px; margin: 0;">
                    Halaman ini menampilkan ringkasan project agar klik dari portofolio tidak jatuh ke 404.
                </p>
            </div>

            <div class="glass-card" style="overflow: hidden;">
                <div class="project-img-wrapper" style="height: 320px;">
                    @php
                        $imageSrc = $project->image_path && str_starts_with($project->image_path, 'images/')
                            ? asset($project->image_path)
                            : ($project->image_path ? asset('storage/' . $project->image_path) : null);
                    @endphp
                    @if($imageSrc)
                        <img src="{{ $imageSrc }}" alt="{{ $project->title }}" class="project-img">
                    @else
                        <div style="display:flex;align-items:center;justify-content:center;height:100%;color:var(--text-muted);">
                            <i class="fa-solid fa-image fa-3x"></i>
                        </div>
                    @endif
                </div>

                <div class="project-content">
                    <div style="display:flex; flex-wrap: wrap; gap: 0.75rem; align-items: center; justify-content: space-between;">
                        <div>
                            <p style="margin: 0; color: var(--text-secondary);">Peran</p>
                            <h2 style="margin: 0.25rem 0 0;">{{ $project->role ?? 'Fullstack Developer' }}</h2>
                        </div>
                        @if($project->featured)
                            <span class="project-featured-tag" style="position: static;">Featured</span>
                        @endif
                    </div>

                    <div class="project-desc-box" style="margin: 1.5rem 0; padding: 1rem; background: rgba(0,0,0,0.2); border-radius: 8px;">
                        <p style="margin: 0;"><strong>Deskripsi:</strong> {{ $project->description }}</p>
                    </div>

                    <div class="project-tags" style="margin-bottom: 2rem;">
                        @foreach($project->tech_stack ?: [] as $tech)
                            <span class="project-tag">{{ $tech }}</span>
                        @endforeach
                    </div>

                    <div class="project-links">
                        <a href="{{ route('portfolio.index') }}#projects" class="project-link">
                            <i class="fa-solid fa-arrow-left"></i> Kembali ke Portofolio
                        </a>
                        @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" rel="noreferrer" class="project-link">
                                <i class="fa-brands fa-github"></i> Kode Sumber
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
