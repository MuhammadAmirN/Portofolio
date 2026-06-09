@extends('layouts.admin')

@section('admin_content')
    <div class="admin-header">
        <div>
            <h1 class="admin-title">Kelola Keahlian</h1>
            <p style="color: var(--text-secondary); font-size: 0.95rem; margin-top: 0.25rem;">
                Tambahkan, edit, atau hapus keahlian teknis yang akan ditampilkan pada portofolio Anda.
            </p>
        </div>
    </div>

    <div class="crud-container">
        <!-- List of Skills (Left Column) -->
        <div class="glass-card">
            <div class="admin-card-header">
                <h2 style="font-size: 1.25rem; font-weight: 700;"><i class="fa-solid fa-list-check" style="margin-right: 0.5rem; color: var(--secondary-color);"></i> Daftar Keahlian</h2>
            </div>
            
            <div class="admin-card-body" style="padding: 0;">
                <div class="table-responsive">
                    @if($skills->isEmpty())
                        <div style="text-align: center; padding: 4rem; color: var(--text-muted);">
                            <i class="fa-solid fa-layer-group fa-3x" style="margin-bottom: 1rem;"></i>
                            <p>Belum ada data keahlian saat ini. Tambahkan di form sebelah kanan.</p>
                        </div>
                    @else
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Keahlian</th>
                                    <th>Kategori</th>
                                    <th>Tingkat</th>
                                    <th style="text-align: right;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($skills as $skill)
                                    <tr id="skill-row-{{ $skill->id }}">
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                                <div style="width: 32px; height: 32px; background: rgba(255, 255, 255, 0.03); border: 1px solid var(--border-color); border-radius: 6px; display: flex; align-items: center; justify-content: center; color: var(--primary-color);">
                                                    <i class="{{ $skill->icon ?: 'fa-solid fa-circle-nodes' }}"></i>
                                                </div>
                                                <div>
                                                    <div style="font-weight: 600;" class="skill-name-txt">{{ $skill->name }}</div>
                                                    <div style="font-size: 0.75rem; color: var(--text-muted);" class="skill-desc-txt">{{ $skill->description }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span style="font-size: 0.85rem; color: var(--text-secondary);" class="skill-cat-txt">{{ $skill->category }}</span>
                                        </td>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                                <strong class="skill-level-txt">{{ $skill->level }}</strong><span style="color: var(--text-muted); font-size: 0.8rem;">%</span>
                                            </div>
                                        </td>
                                        <td style="text-align: right;">
                                            <div class="actions-cell" style="justify-content: flex-end;">
                                                <button type="button" class="btn btn-secondary btn-sm edit-skill-btn" 
                                                        data-id="{{ $skill->id }}"
                                                        data-name="{{ $skill->name }}"
                                                        data-category="{{ $skill->category }}"
                                                        data-level="{{ $skill->level }}"
                                                        data-icon="{{ $skill->icon }}"
                                                        data-description="{{ $skill->description }}"
                                                        aria-label="Edit keahlian">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                
                                                <form action="{{ route('admin.skills.destroy', $skill->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus keahlian ini?');" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-secondary btn-sm" style="color: var(--error);" aria-label="Hapus keahlian">
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
                    <i class="fa-solid fa-plus" style="margin-right: 0.5rem; color: var(--primary-color);"></i> Tambah Keahlian
                </h2>
            </div>
            
            <div class="admin-card-body">
                <form action="{{ route('admin.skills.store') }}" method="POST" id="skill-form">
                    @csrf
                    <div id="method-container"></div>
                    
                    <div class="form-group">
                        <label for="name" class="form-label">Nama Keahlian</label>
                        <input type="text" name="name" id="skill_name" class="form-control" placeholder="Contoh: Laravel Framework" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="category" class="form-label">Kategori</label>
                        <select name="category" id="skill_category" class="form-control" required>
                            <option value="Backend Development">Backend Development</option>
                            <option value="Frontend Development">Frontend Development</option>
                            <option value="DevOps & Tools">DevOps & Tools</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="level" class="form-label">Tingkat Penguasaan (%)</label>
                        <input type="number" name="level" id="skill_level" class="form-control" min="0" max="100" placeholder="Contoh: 90" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="icon" class="form-label">Icon Class (FontAwesome)</label>
                        <input type="text" name="icon" id="skill_icon" class="form-control" placeholder="Contoh: fa-brands fa-laravel">
                        <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 0.25rem;">
                            Gunakan class dari <a href="https://fontawesome.com/search?o=r&m=free" target="_blank" style="color: var(--secondary-color); text-decoration: underline;">FontAwesome Free Icons</a>.
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="description" class="form-label">Deskripsi Keahlian</label>
                        <textarea name="description" id="skill_description" rows="3" class="form-control" placeholder="Tuliskan sedikit penjelasan atau keahlian spesifik..."></textarea>
                    </div>
                    
                    <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                        <button type="submit" class="btn btn-primary" style="flex-grow: 1;" id="submit-btn">
                            Simpan Keahlian
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
            const skillForm = document.getElementById('skill-form');
            const methodContainer = document.getElementById('method-container');
            const submitBtn = document.getElementById('submit-btn');
            const cancelBtn = document.getElementById('cancel-btn');
            
            // Inputs
            const skillNameInput = document.getElementById('skill_name');
            const skillCategoryInput = document.getElementById('skill_category');
            const skillLevelInput = document.getElementById('skill_level');
            const skillIconInput = document.getElementById('skill_icon');
            const skillDescInput = document.getElementById('skill_description');
            
            // Store original route URL
            const storeUrl = skillForm.getAttribute('action');

            document.querySelectorAll('.edit-skill-btn').forEach(button => {
                button.addEventListener('click', () => {
                    const id = button.getAttribute('data-id');
                    const name = button.getAttribute('data-name');
                    const category = button.getAttribute('data-category');
                    const level = button.getAttribute('data-level');
                    const icon = button.getAttribute('data-icon');
                    const description = button.getAttribute('data-description');

                    // 1. Change Title & Header
                    formTitle.innerHTML = `<i class="fa-solid fa-pen-to-square" style="margin-right: 0.5rem; color: var(--secondary-color);"></i> Edit Keahlian: ${name}`;
                    
                    // 2. Set Input values
                    skillNameInput.value = name;
                    skillCategoryInput.value = category;
                    skillLevelInput.value = level;
                    skillIconInput.value = icon || '';
                    skillDescInput.value = description || '';
                    
                    // 3. Configure Form Action to Update Url
                    const updateUrl = `{{ url('/admin/skills') }}/${id}`;
                    skillForm.setAttribute('action', updateUrl);
                    
                    // 4. Inject PUT method
                    methodContainer.innerHTML = '<input type="hidden" name="_method" value="PUT">';
                    
                    // 5. Update buttons
                    submitBtn.innerText = 'Perbarui Keahlian';
                    cancelBtn.style.display = 'block';
                    
                    // Scroll form into view if mobile
                    if (window.innerWidth <= 1024) {
                        formCard.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            });

            cancelBtn.addEventListener('click', () => {
                // 1. Reset Title & Header
                formTitle.innerHTML = `<i class="fa-solid fa-plus" style="margin-right: 0.5rem; color: var(--primary-color);"></i> Tambah Keahlian`;
                
                // 2. Clear values
                skillNameInput.value = '';
                skillCategoryInput.value = 'Backend Development';
                skillLevelInput.value = '';
                skillIconInput.value = '';
                skillDescInput.value = '';
                
                // 3. Reset form action
                skillForm.setAttribute('action', storeUrl);
                
                // 4. Remove PUT method
                methodContainer.innerHTML = '';
                
                // 5. Update buttons
                submitBtn.innerText = 'Simpan Keahlian';
                cancelBtn.style.display = 'none';
            });
        });
    </script>
@endsection
