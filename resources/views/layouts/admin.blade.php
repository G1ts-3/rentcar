<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f1f5f9;
            color: #0f172a;
        }
        
        /* Modern Sidebar */
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            /* Premium Navy Blue Sidebar */
            background: linear-gradient(180deg, #0f172a 0%, #1e3a8a 100%);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.08);
            z-index: 1000;
            overflow-y: auto;
            color: white;
            transition: all 0.3s ease;
        }
        
        .sidebar-brand {
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            margin-bottom: 1rem;
        }
        
        .brand-icon-container {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(37,99,235,0.3);
        }
        
        .sidebar-brand h5 {
            margin: 0;
            font-weight: 800;
            font-size: 1.15rem;
            letter-spacing: -0.5px;
        }

        .sidebar .nav-link {
            font-size: 0.95rem;
            color: #94a3b8;
            padding: 0.8rem 1.5rem;
            margin: 0.3rem 1rem;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.2s ease;
            font-weight: 600;
        }
        
        .sidebar .nav-link i {
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
            color: #64748b;
            transition: color 0.2s ease;
        }

        .sidebar .nav-link.active {
            background-color: rgba(59,130,246,0.15);
            color: white;
            box-shadow: inset 4px 0 0 #3b82f6;
        }
        
        .sidebar .nav-link.active i {
            color: #60a5fa;
        }

        .sidebar .nav-link:hover:not(.active) {
            background-color: rgba(255,255,255,0.05);
            color: white;
            transform: translateX(4px);
        }
        
        .sidebar .nav-link:hover i {
            color: #93c5fd;
        }

        /* Main Content Area */
        .main-content {
            margin-left: 260px;
            padding: 2.5rem;
            min-height: 100vh;
        }

        /* Top Header */
        .content-header {
            background-color: white;
            border-radius: 16px;
            padding: 1.25rem 1.75rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(0,0,0,0.02);
        }

        .content-header h1 {
            font-size: 1.4rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
            letter-spacing: -0.5px;
        }
        
        .btn-logout {
            background-color: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            border-radius: 10px;
            padding: 0.5rem 1rem;
            font-weight: 700;
            font-size: 0.9rem;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-logout:hover {
            background-color: #fee2e2;
            color: #991b1b;
            transform: translateY(-1px);
        }

        /* Cards & Tables styling */
        .card {
            border-radius: 16px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.02);
            border: 1px solid rgba(0,0,0,0.04);
            overflow: hidden;
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid #f1f5f9;
            padding: 1.25rem 1.75rem;
            font-weight: 700;
            font-size: 1.1rem;
            color: #1e293b;
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table thead th {
            background-color: #f8fafc;
            color: #64748b;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 1.25rem 1rem;
            border-bottom: 2px solid #e2e8f0;
            font-weight: 700;
        }
        
        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
            font-weight: 500;
            font-size: 0.95rem;
        }
        
        .btn {
            border-radius: 10px;
            font-weight: 600;
            padding: 0.5rem 1.25rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }
        
        .btn-sm {
            padding: 0.35rem 0.85rem;
            font-size: 0.875rem;
        }
        
        .btn-primary {
            background-color: #1d4ed8;
            border-color: #1d4ed8;
            box-shadow: 0 4px 6px -1px rgba(29,78,216,0.2);
        }
        
        .btn-primary:hover {
            background-color: #1e3a8a;
            border-color: #1e3a8a;
            transform: translateY(-1px);
        }
        
        .btn-info { background-color: #0ea5e9; border-color: #0ea5e9; color: white; }
        .btn-info:hover { background-color: #0284c7; border-color: #0284c7; color: white; }

        /* Custom Alerts */
        .alert {
            border-radius: 12px;
            border: none;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 1rem 1.25rem;
            font-weight: 600;
        }
        
        .alert-success {
            background-color: #eff6ff;
            color: #1d4ed8;
            border-left: 4px solid #3b82f6;
        }
        
        .alert-danger {
            background-color: #fef2f2;
            color: #b91c1c;
            border-left: 4px solid #ef4444;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="container-fluid p-0">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-brand">
                <div class="brand-icon-container" style="background: white;">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 100%; height: 100%; object-fit: contain; padding: 5px; border-radius: 10px;">
                </div>
                <h5>Admin Portal</h5>
            </div>
            
            <ul class="nav flex-column mt-3">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-chart-pie"></i> Dashboard
                    </a>
                </li>
                
                <li class="nav-item mt-4 mb-2 px-4 text-uppercase" style="font-size: 0.7rem; font-weight: 800; letter-spacing: 1px; color: #475569;">
                    Basis Data
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.vehicles.*') ? 'active' : '' }}" href="{{ route('admin.vehicles.index') }}">
                        <i class="fas fa-car-side"></i> Inventaris Kendaraan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.transactions.*') ? 'active' : '' }}" href="{{ route('admin.transactions.index') }}">
                        <i class="fas fa-clipboard-list"></i> Riwayat Transaksi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                        <i class="fas fa-users"></i> Kelola Member
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <div class="content-header">
                <h1>
                    @if(request()->routeIs('admin.dashboard'))
                        <i class="fas fa-chart-pie text-primary me-2"></i>
                    @elseif(request()->routeIs('admin.vehicles.*'))
                        <i class="fas fa-car-side text-primary me-2"></i>
                    @elseif(request()->routeIs('admin.transactions.*'))
                        <i class="fas fa-clipboard-list text-primary me-2"></i>
                    @elseif(request()->routeIs('admin.users.*'))
                        <i class="fas fa-users text-primary me-2"></i>
                    @endif
                    @yield('page-title')
                </h1>
                
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-light rounded-pill px-3 py-1.5 border d-flex align-items-center gap-2">
                        <i class="fas fa-user-circle text-primary fs-5"></i>
                        <span class="fw-bold text-dark small">{{ auth()->user()->name }}</span>
                    </div>
                    
                    <form action="{{ route('logout') }}" method="POST" class="d-inline m-0">
                        @csrf
                        <button type="submit" class="btn-logout">
                            <i class="fas fa-power-off"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <i class="fas fa-check-circle fs-5"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                    <i class="fas fa-exclamation-circle fs-5"></i>
                    <div>{{ session('error') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
