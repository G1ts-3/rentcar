@extends('layouts.admin')

@section('title', 'Tambah Kendaraan')
@section('page-title', 'Tambah Kendaraan')

@section('content')
    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.vehicles.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="vehicle_code" class="form-label">Kode Kendaraan</label>
                    <input type="text" class="form-control @error('vehicle_code') is-invalid @enderror" id="vehicle_code" name="vehicle_code" value="{{ old('vehicle_code') }}" required>
                    @error('vehicle_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="brand" class="form-label">Merek Kendaraan</label>
                    <input type="text" class="form-control @error('brand') is-invalid @enderror" id="brand" name="brand" value="{{ old('brand') }}" required>
                    @error('brand')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Kendaraan</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="plate_number" class="form-label">Nomor Plat</label>
                    <input type="text" class="form-control @error('plate_number') is-invalid @enderror" id="plate_number" name="plate_number" value="{{ old('plate_number') }}" required>
                    @error('plate_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="year" class="form-label">Tahun</label>
                    <input type="number" class="form-control @error('year') is-invalid @enderror" id="year" name="year" value="{{ old('year') }}" required>
                    @error('year')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                        <option value="borrowed" {{ old('status') == 'borrowed' ? 'selected' : '' }}>Dipinjam</option>
                        <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Perawatan</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
