@extends('layouts.admin')

@section('admin_content')
    <div class="admin-header">
        <div>
            <h1 class="admin-title">Pesan Masuk (Inbox)</h1>
            <p style="color: var(--text-secondary); font-size: 0.95rem; margin-top: 0.25rem;">
                Membaca dan mengelola pesan yang dikirim oleh pengunjung melalui formulir kontak.
            </p>
        </div>
    </div>

    <div class="crud-container full-width">
        <!-- List of Messages -->
        <div class="glass-card">
            <div class="admin-card-header">
                <h2 style="font-size: 1.25rem; font-weight: 700;"><i class="fa-solid fa-inbox" style="margin-right: 0.5rem; color: var(--primary-color);"></i> Pesan Anda</h2>
            </div>
            
            <div class="admin-card-body" style="padding: 0;">
                <div class="table-responsive">
                    @if($messages->isEmpty())
                        <div style="text-align: center; padding: 5rem; color: var(--text-muted);">
                            <i class="fa-regular fa-envelope-open fa-3x" style="margin-bottom: 1rem;"></i>
                            <p>Kotak masuk Anda kosong saat ini.</p>
                        </div>
                    @else
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Pengirim</th>
                                    <th>Subjek</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Status</th>
                                    <th style="text-align: right;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($messages as $msg)
                                    <tr id="message-row-{{ $msg->id }}">
                                        <td>
                                            <div style="font-weight: 600;">{{ $msg->name }}</div>
                                            <div style="font-size: 0.85rem; color: var(--text-muted);">{{ $msg->email }}</div>
                                        </td>
                                        <td>
                                            <div style="font-weight: @if($msg->status === 'unread') 600 @else 400 @endif;">
                                                {{ $msg->subject ?: '(Tanpa Subjek)' }}
                                            </div>
                                        </td>
                                        <td style="color: var(--text-secondary); font-size: 0.85rem;">
                                            {{ $msg->created_at->format('d M Y, H:i') }}
                                        </td>
                                        <td class="status-cell">
                                            @if($msg->status === 'unread')
                                                <span class="status-badge badge-unread" id="badge-{{ $msg->id }}">Belum Dibaca</span>
                                            @else
                                                <span class="status-badge badge-read" id="badge-{{ $msg->id }}">Dibaca</span>
                                            @endif
                                        </td>
                                        <td style="text-align: right;">
                                            <div class="actions-cell" style="justify-content: flex-end;">
                                                <button type="button" class="btn btn-primary btn-sm view-message-btn"
                                                        data-id="{{ $msg->id }}"
                                                        data-name="{{ $msg->name }}"
                                                        data-email="{{ $msg->email }}"
                                                        data-subject="{{ $msg->subject ?: '(Tanpa Subjek)' }}"
                                                        data-message="{{ $msg->message }}"
                                                        data-date="{{ $msg->created_at->format('d F Y, H:i') }}"
                                                        aria-label="Baca pesan">
                                                    <i class="fa-regular fa-envelope-open"></i> Baca
                                                </button>
                                                
                                                <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?');" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-secondary btn-sm" style="color: var(--error);" aria-label="Hapus pesan">
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
    </div>

    <!-- Message Detail Modal Overlay -->
    <div class="message-detail-modal" id="message-modal">
        <div class="message-modal-content glass-card">
            <div class="modal-header">
                <h3 style="font-size: 1.25rem; font-weight: 700;"><i class="fa-regular fa-envelope" style="margin-right: 0.5rem; color: var(--primary-color);"></i> Detail Pesan</h3>
                <button type="button" class="modal-close" id="close-modal-btn" aria-label="Tutup"><i class="fa-solid fa-xmark"></i></button>
            </div>
            
            <div class="modal-body">
                <div class="modal-field">
                    <div class="modal-label">Dari</div>
                    <div class="modal-value"><strong id="modal-sender-name"></strong> (<span id="modal-sender-email"></span>)</div>
                </div>
                
                <div class="modal-field">
                    <div class="modal-label">Tanggal Kirim</div>
                    <div class="modal-value" id="modal-sent-date"></div>
                </div>
                
                <div class="modal-field">
                    <div class="modal-label">Subjek</div>
                    <div class="modal-value" id="modal-subject" style="font-weight: 600;"></div>
                </div>
                
                <div class="modal-field">
                    <div class="modal-label">Pesan</div>
                    <div class="modal-message-body" id="modal-message-body"></div>
                </div>
            </div>
            
            <div style="margin-top: 2rem; display: flex; justify-content: flex-end;">
                <button type="button" class="btn btn-secondary" id="close-modal-btn-bottom">Tutup</button>
            </div>
        </div>
    </div>
@endsection

@section('admin_scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('message-modal');
            const closeBtns = [document.getElementById('close-modal-btn'), document.getElementById('close-modal-btn-bottom')];
            
            // Modal Elements
            const modalName = document.getElementById('modal-sender-name');
            const modalEmail = document.getElementById('modal-sender-email');
            const modalDate = document.getElementById('modal-sent-date');
            const modalSubject = document.getElementById('modal-subject');
            const modalBody = document.getElementById('modal-message-body');

            document.querySelectorAll('.view-message-btn').forEach(button => {
                button.addEventListener('click', () => {
                    const id = button.getAttribute('data-id');
                    const name = button.getAttribute('data-name');
                    const email = button.getAttribute('data-email');
                    const subject = button.getAttribute('data-subject');
                    const message = button.getAttribute('data-message');
                    const date = button.getAttribute('data-date');

                    // 1. Populate modal fields
                    modalName.innerText = name;
                    modalEmail.innerText = email;
                    modalDate.innerText = date;
                    modalSubject.innerText = subject;
                    modalBody.innerText = message;

                    // 2. Open Modal
                    modal.classList.add('active');

                    // 3. Mark message as read in the background (AJAX)
                    fetch(`{{ url('/admin/messages') }}/${id}`)
                        .then(response => response.json())
                        .then(data => {
                            // Update badge in DOM if successful
                            const badge = document.getElementById(`badge-${id}`);
                            if (badge && badge.classList.contains('badge-unread')) {
                                badge.className = 'status-badge badge-read';
                                badge.innerText = 'Dibaca';
                                
                                // Decrement the unread count in sidebar if exists
                                const sidebarBadge = document.querySelector('.sidebar-link .badge-unread');
                                if (sidebarBadge) {
                                    let currentCount = parseInt(sidebarBadge.innerText);
                                    if (currentCount > 1) {
                                        sidebarBadge.innerText = currentCount - 1;
                                    } else {
                                        sidebarBadge.remove();
                                    }
                                }
                            }
                        })
                        .catch(err => console.error('Error marking message as read:', err));
                });
            });

            // Close Modal Listeners
            closeBtns.forEach(btn => {
                if (btn) {
                    btn.addEventListener('click', () => {
                        modal.classList.remove('active');
                    });
                }
            });

            // Close modal when clicking outside contents
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.remove('active');
                }
            });
        });
    </script>
@endsection
