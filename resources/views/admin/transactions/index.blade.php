@extends('layouts.admin')

@section('title', 'Daftar Transaksi')
@section('page-title', 'Daftar Transaksi')

@section('content')
    <div class="mb-3">
        <a href="{{ route('admin.transactions.create') }}" class="btn btn-primary">Tambah Transaksi</a>
    </div>

    <!-- Menampilkan informasi transaksi baru jika ada -->
    @if(session('newTransaction'))
        <div class="alert alert-info">
            Transaksi baru berhasil ditambahkan! 
            <strong>ID Transaksi:</strong> {{ session('newTransaction')->id }} 
            <strong>Kendaraan:</strong> {{ session('newTransaction')->vehicle->name }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Anggota</th>
                        <th>Kendaraan</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->user->name }}</td>
                            <td>{{ $transaction->vehicle->name }}</td>
                            <td>{{ $transaction->borrow_date }}</td>
                            <td>{{ $transaction->return_date }}</td>
                            <td>
                                <span class="badge {{ $transaction->status === 'completed' ? 'bg-success' : ($transaction->status === 'ongoing' ? 'bg-primary' : 'bg-warning') }}">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.transactions.show', $transaction) }}" class="btn btn-info btn-sm text-white" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.transactions.destroy', $transaction) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
