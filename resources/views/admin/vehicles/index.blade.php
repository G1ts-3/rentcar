@extends('layouts.admin')

@section('title', 'Kelola Data Kendaraan')
@section('page-title', 'Kelola Data Kendaraan')

@section('content')
    <div class="mb-3">
        <a href="{{ route('admin.vehicles.create') }}" class="btn btn-primary">Tambah Kendaraan</a>
    </div>

    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th>id</th>
                <th>Kode Kendaraan</th>
                <th>Merek Kendaraan</th>
                <th>Nama Kendaraan</th>
                <th>Nomor Plat</th>
                <th>Tahun</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vehicle as $index => $v)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $v->vehicle_code }}</td>
                    <td>{{ $v->brand }}</td>
                    <td>{{ $v->name }}</td>
                    <td>{{ $v->plate_number }}</td>
                    <td>{{ $v->year }}</td>
                    <td>{{ ucfirst($v->status) }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.vehicles.edit', $v->id) }}" class="btn btn-warning btn-sm text-white" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.vehicles.destroy', $v->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus kendaraan ini?')">
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
