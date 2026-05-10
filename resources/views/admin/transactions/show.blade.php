@extends('layouts.admin')

@section('title', 'Detail Transaksi')
@section('page-title', 'Detail Transaksi #' . $transaction->id)

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Informasi Anggota</h5>
                    <p><strong>Nama:</strong> {{ $transaction->user->name }}</p>
                    <p><strong>NIK:</strong> {{ $transaction->user->nik }}</p>
                    <p><strong>Jabatan:</strong> {{ $transaction->user->position }}</p>
                    <p><strong>No. Telp:</strong> {{ $transaction->user->phone }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Informasi Kendaraan</h5>
                    <p><strong>Nama:</strong> {{ $transaction->vehicle->name }}</p>
                    <p><strong>Merek:</strong> {{ $transaction->vehicle->brand }}</p>
                    <p><strong>Plat Nomor:</strong> {{ $transaction->vehicle->plate_number }}</p>
                    <p><strong>Tahun:</strong> {{ $transaction->vehicle->year }}</p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12">
                    <h5>Informasi Transaksi</h5>
                    <p><strong>Tanggal Pinjam:</strong> {{ $transaction->borrow_date }}</p>
                    <p><strong>Tanggal Kembali:</strong> {{ $transaction->return_date }}</p>
                    <p><strong>Status:</strong> 
                        <span class="badge {{ $transaction->status === 'completed' ? 'bg-success' : ($transaction->status === 'ongoing' ? 'bg-primary' : 'bg-warning') }}">
                            {{ ucfirst($transaction->status) }}
                        </span>
                    </p>
                </div>
            </div>

            <form action="{{ route('admin.transactions.update', $transaction) }}" method="POST" class="mb-3">
                @csrf
                @method('PUT')
                <div class="row align-items-end">
                    <div class="col-md-6">
                        <label class="form-label">Update Status</label>
                        <select name="status" class="form-select">
                            <option value="pending" {{ $transaction->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="ongoing" {{ $transaction->status === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                            <option value="completed" {{ $transaction->status === 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection