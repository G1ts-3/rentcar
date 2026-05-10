<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Member Area</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; color: #0f172a; }
        .glass-nav { background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(10px); border-bottom: 1px solid rgba(255,255,255,0.1); }
        .nav-link { position: relative; transition: all 0.3s ease; }
        .nav-link::after { content: ''; position: absolute; bottom: -20px; left: 0; width: 0%; height: 3px; background-color: #3b82f6; transition: all 0.3s ease; border-radius: 3px 3px 0 0; }
        .nav-link:hover::after, .nav-link.active::after { width: 100%; }
        .nav-link.active { color: #60a5fa !important; font-weight: 700; }
        .nav-link:hover { color: #93c5fd !important; }
    </style>
    @stack('styles')
</head>
<body class="antialiased min-h-screen flex flex-col">
    
    <!-- Navigation -->
    <nav class="glass-nav fixed w-full z-50 top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <!-- Logo & Brand -->
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30 overflow-hidden p-1">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-contain">
                    </div>
                    <span class="font-extrabold text-xl text-white tracking-tight">Portal <span class="text-blue-400">Member</span></span>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('member.dashboard') }}" class="nav-link {{ request()->routeIs('member.dashboard') ? 'active' : '' }} text-slate-300 font-semibold flex items-center gap-2">
                        <i class="fas fa-chart-pie"></i> Beranda
                    </a>
                    <a href="{{ route('member.borrow.index') }}" class="nav-link {{ request()->routeIs('member.borrow.*') ? 'active' : '' }} text-slate-300 font-semibold flex items-center gap-2">
                        <i class="fas fa-key"></i> Pinjam Kendaraan
                    </a>
                    <a href="{{ route('member.return.index') }}" class="nav-link {{ request()->routeIs('member.return.*') ? 'active' : '' }} text-slate-300 font-semibold flex items-center gap-2">
                        <i class="fas fa-undo-alt"></i> Pengembalian
                    </a>
                </div>

                <!-- User Menu -->
                <div class="flex items-center gap-4">
                    <div class="hidden md:flex items-center gap-3 bg-slate-800/50 px-4 py-2 rounded-full border border-slate-700/50">
                        <div class="w-8 h-8 rounded-full bg-blue-900/50 flex items-center justify-center text-blue-400 border border-blue-500/20">
                            <i class="fas fa-user text-sm"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-white leading-tight">{{ auth()->user()->name }}</span>
                            <span class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider">{{ auth()->user()->position ?? 'Member' }}</span>
                        </div>
                    </div>
                    
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="bg-red-500/10 hover:bg-red-500 hover:text-white text-red-500 p-2.5 rounded-xl transition-all duration-300 flex items-center justify-center" title="Keluar dari Sistem">
                            <i class="fas fa-power-off"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow pt-24 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-xl shadow-sm flex items-center gap-3 animate-fade-in-down">
                    <div class="text-blue-500 bg-white rounded-full p-1"><i class="fas fa-check-circle text-xl"></i></div>
                    <p class="text-blue-800 font-semibold">{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl shadow-sm flex items-center gap-3 animate-fade-in-down">
                    <div class="text-red-500 bg-white rounded-full p-1"><i class="fas fa-exclamation-circle text-xl"></i></div>
                    <p class="text-red-800 font-semibold">{{ session('error') }}</p>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 border-t border-slate-800 mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between text-center md:text-left">
                <div class="flex justify-center md:justify-start mb-4 md:mb-0 text-slate-400 items-center gap-2 text-sm font-medium">
                    <i class="fas fa-shield-alt text-blue-500"></i>
                    Sistem Terenkripsi &copy; {{ date('Y') }} Rental Kendaraan
                </div>
                <div class="text-slate-500 text-sm font-medium flex items-center justify-center gap-1">
                    Dikembangkan dengan <i class="fas fa-heart text-red-500 text-xs mx-1"></i> untuk kenyamanan Anda
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
    <style>
        @keyframes fadeInDown {
            0% { opacity: 0; transform: translateY(-10px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-down { animation: fadeInDown 0.4s ease-out; }
    </style>
</body>
</html>