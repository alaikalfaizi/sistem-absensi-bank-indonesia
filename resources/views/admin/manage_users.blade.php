@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="font-weight-bold mb-4 mt-5">Manajemen Akun</h3>
    <div style="overflow-x: auto;">
        <table class="table table-sm table-bordered table-striped mb-5">
            <thead class="table-dark">
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Terakhir Login</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="badge bg-primary">{{ ucfirst($user->role) }}</span>
                    </td>
                    <td>
                        @if ($user->last_login_at)
                        {{ \Carbon\Carbon::parse($user->last_login_at)->format('d M Y, H:i') }}
                        @else
                        <span class="text-muted">Belum pernah login</span>
                        @endif
                    </td>
                    <td>
                        @if ($user->last_login_at && \Carbon\Carbon::parse($user->last_login_at)->gt(now()->subDays(3)))
                        <span class="badge bg-success">Aktif</span>
                        @else
                        <span class="badge bg-secondary">Tidak Aktif</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data pengguna.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection