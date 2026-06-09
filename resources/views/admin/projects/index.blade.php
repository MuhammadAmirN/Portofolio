@extends('layouts.admin')

@section('admin_content')
    <div class="admin-header">
        <div>
            <h1 class="admin-title">Kelola Proyek</h1>
            <p style="color: var(--text-secondary); font-size: 0.95rem; margin-top: 0.25rem;">
                Tambahkan, perbarui, atau hapus proyek portofolio Anda.
            </p>
        </div>
    </div>

    <div class="crud-container">
        <!-- List of Projects (Left Column) -->
        <div class="glass-card">
            <div class="admin-card-header">
                <h2 style="font-size: 1.25rem; font-weight: 700;"><i class="fa-solid fa-folder-open" style="margin-right: 0.5rem; color: var(--secondary-color);"></i> Daftar Proyek</h2>
            </div>
            
            <div class="admin-card-body" style="padding: 0;">
                <div class="table-responsive">
                    @if($projects->isEmpty())
                        <div style="text-align: center; padding: 4rem; color: var(--text-muted);">
                            <i class="fa-solid fa-laptop-code fa-3x" style="margin-bottom: 1rem;"></i>
                            <p>Belum ada proyek saat ini. Silakan tambahkan proyek baru.</p>
                        </div>
                    @else
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Info Proyek</th>
                                    <th>Tech Stack</th>
                                    <th>Status</th>
                                    <th style="text-align: right;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($projects as $project)
                                    <tr id="project-row-{{ $project->id }}">
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 1rem;">
                                                <div style="width: 70px; height: 45px; background: rgba(255, 255, 255, 0.02); border: 1px solid var(--border-color); border-radius: 4px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                                                    @if($project->image_path)
                                                        @if(str_starts_with($project->image_path, 'images/'))
                                                            <img src="{{ asset($project->image_path) }}" alt="{{ $project->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                                        @else
                                                            <img src="{{ asset('storage/' . $project->image_path) }}" alt="{{ $project->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                                        @endif
                                                    @else
                                                        <i class="fa-regular fa-image" style="color: var(--text-muted);"></i>
                                                    @endif
                                                </div>
                                                <div>
                                                    <div style="font-weight: 600;">{{ $project->title }}</div>
                                                    <div style="font-size: 0.75rem; color: var(--text-muted); display: flex; gap: 0.75rem; margin-top: 0.25rem;">
                                                        @if($project->project_url)
                                                            <span><i class="fa-solid fa-link"></i> Live</span>
                                                        @endif
                                                        @if($project->github_url)
                                                            <span><i class="fa-brands fa-github"></i> Code</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div style="display: flex; flex-wrap: wrap; gap: 0.25rem; max-width: 250px;">
                                                @foreach($project->tech_stack ?: [] as $tech)
                                                    <span class="project-tag" style="padding: 0.1rem 0.4rem; font-size: 0.7rem;">{{ $tech }}</span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td>
                                            @if($project->featured)
                                                <span class="status-badge badge-unread" style="background: rgba(99, 102, 241, 0.1); color: #818cf8; border: 1px solid rgba(99, 102, 241, 0.2);">Utama</span>
                                            @else
                                                <span class="status-badge badge-read">Biasa</span>
                                            @endif
                                        </td>
                                        <td style="text-align: right;">
                                            <div class="actions-cell" style="justify-content: flex-end;">
                                                <button type="button" class="btn btn-secondary btn-sm edit-project-btn" 
                                                        data-id="{{ $project->id }}"
                                                        data-title="{{ $project->title }}"
                                                        data-description="{{ $project->description }}"
                                                        data-tech="{{ implode(', ', $project->tech_stack ?: []) }}"
                                                        data-project-url="{{ $project->project_url }}"
                                                        data-github-url="{{ $project->github_url }}"
                                                        data-image-path="{{ $project->image_path }}"
                                                        data-featured="{{ $project->featured ? '1' : '0' }}"
                                                        aria-label="Edit proyek">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                
                                                <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus proyek ini?');" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-secondary btn-sm" style="color: var(--error);" aria-label="Hapus proyek">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>

        <!-- Add/Edit Form (Right Column) -->
        <div class="glass-card" id="form-card">
            <div class="admin-card-header">
                <h2 style="font-size: 1.25rem; font-weight: 700;" id="form-title">
                    <i class="fa-solid fa-plus" style="margin-right: 0.5rem; color: var(--primary-color);"></i> Tambah Proyek
                </h2>
            </div>
            
            <div class="admin-card-body">
                <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" id="project-form">
                    @csrf
                    <div id="method-container"></div>
                    
                    <div class="form-group">
                        <label for="title" class="form-label">Judul Proyek</label>
                        <input type="text" name="title" id="proj_title" class="form-control" placeholder="Contoh: E-Commerce System" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="description" class="form-label">Deskripsi Proyek</label>
                        <textarea name="description" id="proj_description" rows="4" class="form-control" placeholder="Tuliskan penjelasan detail proyek..." required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="tech_stack" class="form-label">Tech Stack (Pisahkan dengan koma)</label>
                        <input type="text" name="tech_stack" id="proj_tech_stack" class="form-control" placeholder="Contoh: Laravel, VueJS, SQLite" required>
                        <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 0.25rem;">
                            Setiap item dipisahkan oleh tanda koma (,).
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="project_url" class="form-label">Link Demo (Live URL)</label>
                        <input type="url" name="project_url" id="proj_project_url" class="form-control" placeholder="https://demo.com">
                    </div>
                    
                    <div class="form-group">
                        <label for="github_url" class="form-label">Link Repositori (GitHub URL)</label>
                        <input type="url" name="github_url" id="proj_github_url" class="form-control" placeholder="https://github.com/username/repo">
                    </div>
                    
                    <div class="form-group">
                        <label for="image" class="form-label">Gambar Preview</label>
                        <input type="file" name="image" id="proj_image" class="form-control" accept="image/*">
                        
                        <!-- Image Preview -->
                        <div id="image-preview-container" style="display: none; margin-top: 0.75rem;">
                            <span style="font-size: 0.75rem; color: var(--text-muted); display: block; margin-bottom: 0.25rem;">Preview saat ini:</span>
                            <img id="image-preview" src="" alt="Preview Gambar" style="max-width: 100%; max-height: 120px; border-radius: 4px; border: 1px solid var(--border-color);">
                        </div>
                    </div>
                    
                    <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem; margin-top: 1.5rem; margin-bottom: 1.5rem;">
                        <input type="checkbox" name="featured" id="proj_featured" value="1" style="cursor: pointer;">
                        <label for="proj_featured" class="form-label" style="margin-bottom: 0; cursor: pointer; font-size: 0.9rem;">Jadikan Proyek Utama (Featured)</label>
                    </div>
                    
                    <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                        <button type="submit" class="btn btn-primary" style="flex-grow: 1;" id="submit-btn">
                            Simpan Proyek
                        </button>
                        <button type="button" class="btn btn-secondary" style="display: none;" id="cancel-btn">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('admin_scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const formCard = document.getElementById('form-card');
            const formTitle = document.getElementById('form-title');
            const projectForm = document.getElementById('project-form');
            const methodContainer = document.getElementById('method-container');
            const submitBtn = document.getElementById('submit-btn');
            const cancelBtn = document.getElementById('cancel-btn');
            
            // Inputs
            const projTitleInput = document.getElementById('proj_title');
            const projDescInput = document.getElementById('proj_description');
            const projTechInput = document.getElementById('proj_tech_stack');
            const projProjUrlInput = document.getElementById('proj_project_url');
            const projGitUrlInput = document.getElementById('proj_github_url');
            const projFeaturedInput = document.getElementById('proj_featured');
            
            // Image preview fields
            const imgPreviewContainer = document.getElementById('image-preview-container');
            const imgPreview = document.getElementById('image-preview');
            
            const storeUrl = projectForm.getAttribute('action');

            document.querySelectorAll('.edit-project-btn').forEach(button => {
                button.addEventListener('click', () => {
                    const id = button.getAttribute('data-id');
                    const title = button.getAttribute('data-title');
                    const description = button.getAttribute('data-description');
                    const tech = button.getAttribute('data-tech');
                    const projUrl = button.getAttribute('data-project-url');
                    const gitUrl = button.getAttribute('data-github-url');
                    const imgPath = button.getAttribute('data-image-path');
                    const featured = button.getAttribute('data-featured');

                    // 1. Title
                    formTitle.innerHTML = `<i class="fa-solid fa-pen-to-square" style="margin-right: 0.5rem; color: var(--secondary-color);"></i> Edit Proyek: ${title}`;
                    
                    // 2. Set Inputs
                    projTitleInput.value = title;
                    projDescInput.value = description;
                    projTechInput.value = tech;
                    projProjUrlInput.value = projUrl || '';
                    projGitUrlInput.value = gitUrl || '';
                    projFeaturedInput.checked = featured === '1';
                    
                    // 3. Image Preview
                    if (imgPath) {
                        let finalSrc = '';
                        if (imgPath.startsWith('images/')) {
                            finalSrc = `{{ asset('') }}${imgPath}`;
                        } else {
                            finalSrc = `{{ asset('storage') }}/${imgPath}`;
                        }
                        imgPreview.src = finalSrc;
                        imgPreviewContainer.style.display = 'block';
                    } else {
                        imgPreviewContainer.style.display = 'none';
                    }
                    
                    // 4. Form Action to Update
                    const updateUrl = `{{ url('/admin/projects') }}/${id}`;
                    projectForm.setAttribute('action', updateUrl);
                    
                    // 5. Method PUT
                    methodContainer.innerHTML = '<input type="hidden" name="_method" value="PUT">';
                    
                    // 6. Buttons
                    submitBtn.innerText = 'Perbarui Proyek';
                    cancelBtn.style.display = 'block';
                    
                    if (window.innerWidth <= 1024) {
                        formCard.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            });

            cancelBtn.addEventListener('click', () => {
                // 1. Reset Title
                formTitle.innerHTML = `<i class="fa-solid fa-plus" style="margin-right: 0.5rem; color: var(--primary-color);"></i> Tambah Proyek`;
                
                // 2. Clear values
                projTitleInput.value = '';
                projDescInput.value = '';
                projTechInput.value = '';
                projProjUrlInput.value = '';
                projGitUrlInput.value = '';
                projFeaturedInput.checked = false;
                
                // 3. Hide Preview
                imgPreviewContainer.style.display = 'none';
                imgPreview.src = '';
                
                // 4. Reset form action
                projectForm.setAttribute('action', storeUrl);
                
                // 5. Remove PUT method
                methodContainer.innerHTML = '';
                
                // 6. Buttons
                submitBtn.innerText = 'Simpan Proyek';
                cancelBtn.style.display = 'none';
            });
        });
    </script>
@endsection
