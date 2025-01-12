<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Kendaraan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Kelola Data Kendaraan</h1>
        <div class="mb-3">
            <a href="{{ route('admin.vehicles.create') }}" class="btn btn-primary">Tambah Kendaraan</a>
            <a href="{{route('admin.dashboard')}}" class="btn btn-danger">Kembali</a>
        </div>
        
        <!-- Tampilkan pesan sukses atau error -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <table class="table table-bordered">
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
                            <a href="{{ route('admin.vehicles.edit', $v->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.vehicles.destroy', $v->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kendaraan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
