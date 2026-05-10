@extends('layouts.member')

@section('title', 'Dashboard Member')

@section('content')
<div class="py-6">
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-slate-900 via-blue-900 to-blue-800 rounded-3xl p-8 mb-8 shadow-xl shadow-blue-900/20 text-white relative overflow-hidden border border-blue-800/50">
        <div class="absolute top-0 right-0 -mt-10 -mr-10 opacity-10">
            <i class="fas fa-building" style="font-size: 20rem;"></i>
        </div>
        <div class="relative z-10">
            <h1 class="text-3xl font-extrabold mb-2 tracking-tight">Selamat Datang, {{ auth()->user()->name }}!</h1>
            <p class="text-blue-200 text-lg max-w-2xl font-medium">Portal rental kendaraan. Pantau status dan ajukan peminjaman dengan mudah.</p>
            
            <div class="mt-8 flex flex-wrap gap-4">
                <a href="{{ route('member.borrow.index') }}" class="bg-white text-blue-900 hover:bg-blue-50 px-6 py-3 rounded-xl font-bold transition-all shadow-lg flex items-center gap-2 transform hover:-translate-y-1">
                    <i class="fas fa-key text-blue-600"></i> Pinjam Kendaraan
                </a>
                <a href="{{ route('member.return.index') }}" class="bg-blue-800/50 hover:bg-blue-700/50 border border-blue-400/30 text-white px-6 py-3 rounded-xl font-bold transition-all backdrop-blur-sm flex items-center gap-2 transform hover:-translate-y-1">
                    <i class="fas fa-undo-alt text-blue-300"></i> Pengembalian
                </a>
            </div>
        </div>
    </div>

    <!-- Active Transactions Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-extrabold text-slate-800 flex items-center gap-3 tracking-tight">
                <div class="w-10 h-10 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center shadow-inner">
                    <i class="fas fa-clock"></i>
                </div>
                Pinjaman Aktif Anda
            </h2>
        </div>

        @if($activeTransactions->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($activeTransactions as $transaction)
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 hover:shadow-lg transition-shadow relative overflow-hidden group">
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-orange-400 to-red-500"></div>
                        
                        <div class="flex justify-between items-start mb-4">
                            <div class="bg-slate-50 p-3 rounded-xl border border-slate-100 group-hover:scale-110 transition-transform">
                                <i class="fas fa-car-side text-2xl text-slate-600"></i>
                            </div>
                            <span class="bg-orange-100 text-orange-700 text-xs font-bold px-3 py-1.5 rounded-lg border border-orange-200 flex items-center gap-1.5 shadow-sm">
                                <span class="relative flex h-2 w-2">
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                                </span>
                                Sedang Dipinjam
                            </span>
                        </div>
                        
                        <h3 class="text-xl font-bold text-slate-900 mb-1">{{ $transaction->vehicle->name }}</h3>
                        <p class="text-slate-500 font-mono text-sm mb-5 bg-slate-50 inline-block px-2 py-1 rounded-md"><i class="fas fa-hashtag text-slate-400 mr-1 text-xs"></i>{{ $transaction->vehicle->plate_number }}</p>
                        
                        <div class="space-y-3 pt-4 border-t border-slate-100">
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500 font-medium"><i class="far fa-calendar-check text-slate-400 mr-1.5"></i>Tgl Pinjam</span>
                                <span class="font-bold text-slate-800">{{ \Carbon\Carbon::parse($transaction->borrow_date)->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500 font-medium"><i class="far fa-clock text-slate-400 mr-1.5"></i>Jam Pinjam</span>
                                <span class="font-bold text-slate-800">{{ \Carbon\Carbon::parse($transaction->borrow_date)->format('H:i') }}</span>
                            </div>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('member.return.index') }}" class="w-full block text-center bg-slate-50 hover:bg-slate-100 text-slate-700 font-bold py-2.5 rounded-xl border border-slate-200 transition-colors">
                                <i class="fas fa-arrow-right mr-1"></i> Proses Pengembalian
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-3xl p-10 text-center border border-slate-200 shadow-sm">
                <div class="w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-check-double text-4xl text-blue-500"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-2">Tidak Ada Pinjaman Aktif</h3>
                <p class="text-slate-500 mb-6 max-w-md mx-auto font-medium">Anda saat ini tidak sedang meminjam kendaraan apapun. Silakan ajukan pinjaman jika Anda membutuhkan kendaraan.</p>
                <a href="{{ route('member.borrow.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition-colors shadow-md shadow-blue-600/20">
                    <i class="fas fa-plus mr-2"></i> Ajukan Pinjaman Baru
                </a>
            </div>
        @endif
    </div>

    <!-- History Section -->
    <div>
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-extrabold text-slate-800 flex items-center gap-3 tracking-tight">
                <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center shadow-inner">
                    <i class="fas fa-history"></i>
                </div>
                Riwayat Transaksi
            </h2>
        </div>
        
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            @if($transactions->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Kendaraan</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Tanggal Pinjam</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Tanggal Kembali</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-100">
                            @foreach($transactions as $transaction)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-slate-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-car text-slate-500"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-bold text-slate-900">{{ $transaction->vehicle->name }}</div>
                                            <div class="text-xs font-mono text-slate-500 mt-0.5">{{ $transaction->vehicle->plate_number }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-slate-900">{{ \Carbon\Carbon::parse($transaction->borrow_date)->format('d M Y') }}</div>
                                    <div class="text-xs text-slate-500 mt-0.5">{{ \Carbon\Carbon::parse($transaction->borrow_date)->format('H:i') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($transaction->return_date)
                                        <div class="text-sm font-medium text-slate-900">{{ \Carbon\Carbon::parse($transaction->return_date)->format('d M Y') }}</div>
                                        <div class="text-xs text-slate-500 mt-0.5">{{ \Carbon\Carbon::parse($transaction->return_date)->format('H:i') }}</div>
                                    @else
                                        <span class="text-slate-400 text-sm italic font-medium">- Belum kembali -</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($transaction->status === 'ongoing')
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-lg bg-orange-100 text-orange-800 border border-orange-200">
                                            Dipinjam
                                        </span>
                                    @else
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-lg bg-emerald-100 text-emerald-800 border border-emerald-200">
                                            Selesai
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-12 text-center">
                    <div class="text-slate-300 mb-4"><i class="fas fa-clipboard-list text-5xl"></i></div>
                    <p class="text-slate-500 font-medium">Belum ada riwayat transaksi peminjaman.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
