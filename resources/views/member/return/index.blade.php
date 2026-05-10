@extends('layouts.member')

@section('title', 'Pengembalian Kendaraan')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header Section -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden mb-8 relative">
            <div class="absolute top-0 right-0 -mt-10 -mr-10 text-slate-50 opacity-60">
                <i class="fas fa-undo-alt" style="font-size: 14rem;"></i>
            </div>
            <div class="p-8 md:p-10 relative z-10">
                <div class="flex items-center gap-4 mb-3">
                    <div class="w-14 h-14 bg-indigo-50 border border-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center text-2xl shadow-inner">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                        Pengembalian Kendaraan
                    </h2>
                </div>
                <p class="text-slate-500 md:ml-[72px] font-medium text-lg">
                    Pilih kendaraan dari daftar yang aktif yang ingin Anda kembalikan.
                </p>
            </div>
        </div>

        @if($activeTransactions->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @foreach($activeTransactions as $transaction)
                    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 relative group">
                        
                        <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-orange-400 to-red-500"></div>
                        
                        <div class="p-8">
                            <div class="flex justify-between items-start mb-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400 border border-slate-100 shadow-inner group-hover:scale-110 transition-transform">
                                        <i class="fas fa-car text-xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-extrabold text-slate-900 leading-tight tracking-tight">
                                            {{ $transaction->vehicle->name }}
                                        </h3>
                                        <div class="text-sm font-bold text-slate-500 font-mono mt-1 bg-slate-100 inline-block px-2 py-0.5 rounded">
                                            <i class="fas fa-hashtag text-slate-400 text-xs mr-1"></i>{{ $transaction->vehicle->plate_number }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="space-y-4 bg-slate-50 rounded-2xl p-5 mb-8 border border-slate-100 shadow-inner">
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-slate-500 font-bold flex items-center gap-2"><i class="far fa-calendar-check text-slate-400 w-4"></i> Tgl Pinjam</span>
                                    <span class="font-extrabold text-slate-800">{{ \Carbon\Carbon::parse($transaction->borrow_date)->format('d M Y') }}</span>
                                </div>
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-slate-500 font-bold flex items-center gap-2"><i class="far fa-clock text-slate-400 w-4"></i> Jam Pinjam</span>
                                    <span class="font-extrabold text-slate-800">{{ \Carbon\Carbon::parse($transaction->borrow_date)->format('H:i') }}</span>
                                </div>
                            </div>

                            <form action="{{ route('member.return.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
                                <button type="submit" class="w-full inline-flex justify-center items-center px-5 py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-md shadow-indigo-600/20 group-hover:shadow-lg group-hover:shadow-indigo-600/30">
                                    <i class="fas fa-undo-alt mr-2"></i> Kembalikan Kendaraan
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-20 text-center">
                <div class="w-28 h-28 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-6 border-4 border-emerald-100 relative shadow-inner">
                    <i class="fas fa-shield-check text-5xl text-emerald-500"></i>
                    <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md border border-slate-100">
                        <i class="fas fa-car text-slate-400 text-sm"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-extrabold text-slate-900 mb-3 tracking-tight">Catatan Bersih</h3>
                <p class="text-slate-500 max-w-md mx-auto mb-8 font-medium text-lg">Anda tidak memiliki tanggungan peminjaman kendaraan saat ini. Semua aset telah dikembalikan dengan baik.</p>
                <a href="{{ route('member.borrow.index') }}" class="inline-flex items-center justify-center px-8 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition-all shadow-md shadow-blue-600/20">
                    <i class="fas fa-plus mr-2"></i> Ajukan Pinjaman Baru
                </a>
            </div>
        @endif
        
    </div>
</div>
@endsection