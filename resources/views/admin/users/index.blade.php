@extends('layouts.admin')

@section('title', 'Kelola Anggota')
@section('page-title', 'Kelola Anggota')

@section('content')
    <div class="mb-3">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Tambah Anggota</a>
    </div>

    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th>ID</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Role</th> <!-- Added Role Column -->
                <th>No Telp</th>
                <th>Username</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->nik }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->position }}</td>
                    <td>{{ ucfirst($user->role) }}</td> <!-- Display Role -->
                    <td>{{ $user->number_phone }}</td>
                    <td>{{ $user->username }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm text-white" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
