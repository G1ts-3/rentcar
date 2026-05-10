@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'HI, ' . auth()->user()->name)

@section('content')
    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="card-title">Kendaraan Tersedia</h5>
                        <p class="card-text fs-3">{{ $availableVehicles }}</p>
                    </div>
                    <i class="fas fa-car fa-2x mt-2"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="card-title">Total Transaksi</h5>
                        <p class="card-text fs-3">{{ $totalTransactions }}</p>
                    </div>
                    <i class="fas fa-exchange-alt fa-2x mt-2"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="card-title">Anggota Terdaftar</h5>
                        <p class="card-text fs-3">{{ $registeredUsers }}</p>
                    </div>
                    <i class="fas fa-users fa-2x mt-2"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Selamat Datang</h5>
            <p class="card-text">Selamat datang di halaman dashboard admin. Gunakan menu di sebelah kiri untuk mengelola sistem.</p>
        </div>
    </div>
@endsection