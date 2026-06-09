@extends('layouts.admin')

@section('admin_content')
    <div class="admin-header">
        <div>
            <h1 class="admin-title">Dashboard</h1>
            <p style="color: var(--text-secondary); font-size: 0.95rem; margin-top: 0.25rem;">
                Selamat datang kembali, <strong>{{ Auth::user()->name }}</strong>! Berikut ringkasan portofolio Anda.
            </p>
        </div>
    </div>

    <!-- Quick Stats Grid -->
    <div class="stats-grid">
        <div class="stat-box glass-card">
            <div class="stat-box-icon icon-blue">
                <i class="fa-solid fa-server"></i>
            </div>
            <div class="stat-box-info">
                <h3>{{ $stats['skills_count'] }}</h3>
                <p>Total Keahlian</p>
            </div>
        </div>
        
        <div class="stat-box glass-card">
            <div class="stat-box-icon icon-purple">
                <i class="fa-solid fa-laptop-code"></i>
            </div>
            <div class="stat-box-info">
                <h3>{{ $stats['projects_count'] }}</h3>
                <p>Total Proyek</p>
            </div>
        </div>
        
        <div class="stat-box glass-card">
            <div class="stat-box-icon icon-green">
                <i class="fa-solid fa-envelope"></i>
            </div>
            <div class="stat-box-info">
                <h3>{{ $stats['messages_count'] }}</h3>
                <p>Total Pesan</p>
            </div>
        </div>
        
        <div class="stat-box glass-card">
            <div class="stat-box-icon icon-orange">
                <i class="fa-solid fa-envelope-open-text"></i>
            </div>
            <div class="stat-box-info">
                <h3>{{ $stats['unread_messages'] }}</h3>
                <p>Pesan Belum Dibaca</p>
            </div>
        </div>
    </div>

    <!-- Recent Messages Card -->
    <div class="glass-card" style="margin-top: 2rem;">
        <div class="admin-card-header">
            <h2 style="font-size: 1.2rem; font-weight: 700;"><i class="fa-solid fa-inbox" style="margin-right: 0.5rem; color: var(--primary-color);"></i> Pesan Masuk Terbaru</h2>
            <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary btn-sm">Lihat Semua Inbox</a>
        </div>
        
        <div class="admin-card-body" style="padding: 0;">
            <div class="table-responsive">
                @if($recentMessages->isEmpty())
                    <div style="text-align: center; padding: 3rem; color: var(--text-muted);">
                        <i class="fa-regular fa-folder-open fa-3x" style="margin-bottom: 1rem;"></i>
                        <p>Belum ada pesan masuk saat ini.</p>
                    </div>
                @else
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Pengirim</th>
                                <th>Subjek</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th style="text-align: right;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentMessages as $msg)
                                <tr>
                                    <td>
                                        <div style="font-weight: 600;">{{ $msg->name }}</div>
                                        <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $msg->email }}</div>
                                    </td>
                                    <td>
                                        <div style="max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            {{ $msg->subject ?: '(Tanpa Subjek)' }}
                                        </div>
                                    </td>
                                    <td style="color: var(--text-secondary); font-size: 0.85rem;">
                                        {{ $msg->created_at->format('d M Y, H:i') }}
                                    </td>
                                    <td>
                                        @if($msg->status === 'unread')
                                            <span class="status-badge badge-unread">Belum Dibaca</span>
                                        @else
                                            <span class="status-badge badge-read">Dibaca</span>
                                        @endif
                                    </td>
                                    <td style="text-align: right;">
                                        <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary btn-sm">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
