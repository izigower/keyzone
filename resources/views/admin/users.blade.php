@extends('layouts.app')
@section('title', 'Utilisateurs - Admin')
@section('content')
<div style="max-width: 1400px; margin: 2rem auto; padding: 0 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1 style="font-size: 2rem; color: #a78bfa;"><i class="fas fa-users"></i> Gestion des utilisateurs</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Retour</a>
    </div>
    <div class="table-container" style="background: rgba(30, 33, 52, 0.7); border-radius: 12px;">
        <table>
            <thead><tr><th>ID</th><th>Username</th><th>Email</th><th>Rôle</th><th>Vérifié</th><th>Actif</th><th>Actions</th></tr></thead>
            <tbody>
                @foreach($users as $u)
                    <tr>
                        <td>{{ $u->id }}</td>
                        <td style="font-weight: 600;">{{ $u->username }}</td>
                        <td style="color: #94a3b8;">{{ $u->email }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.users.role', $u->id) }}" style="display: inline;">
                                @csrf @method('PUT')
                                <select name="role" onchange="this.form.submit()" style="background: rgba(15,15,30,0.6); border: 1px solid rgba(139,92,246,0.3); border-radius: 4px; color: {{ $u->role === 'admin' ? '#a78bfa' : '#fff' }}; padding: 0.3rem 0.5rem;">
                                    <option value="user" {{ $u->role === 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ $u->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </form>
                        </td>
                        <td>{!! $u->hasVerifiedEmail() ? '<span style="color: #34d399;">&#10003;</span>' : '<span style="color: #f87171;">&#10007;</span>' !!}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.users.toggle', $u->id) }}" style="display: inline;">
                                @csrf @method('PUT')
                                <button type="submit" style="background: none; border: none; cursor: pointer; color: {{ $u->is_active ? '#34d399' : '#f87171' }}; font-size: 1.2rem;" title="{{ $u->is_active ? 'Désactiver' : 'Activer' }}">
                                    <i class="fas fa-{{ $u->is_active ? 'toggle-on' : 'toggle-off' }}"></i>
                                </button>
                            </form>
                        </td>
                        <td style="color: #71717a; font-size: 0.85rem;">{{ $u->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $users->links() }}
</div>
@endsection
