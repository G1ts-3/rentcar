@extends('layouts.member')

@section('title', 'Peminjaman Kendaraan')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header Section -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden mb-8 relative">
            <div class="absolute top-0 right-0 -mt-10 -mr-10 text-slate-50 opacity-60">
                <i class="fas fa-key" style="font-size: 14rem;"></i>
            </div>
            <div class="p-8 md:p-10 relative z-10">
                <div class="flex items-center gap-4 mb-3">
                    <div class="w-14 h-14 bg-blue-50 border border-blue-100 text-blue-600 rounded-2xl flex items-center justify-center text-2xl shadow-inner">
                        <i class="fas fa-car-side"></i>
                    </div>
                    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                        Pilih Kendaraan
                    </h2>
                </div>
                <p class="text-slate-500 md:ml-[72px] font-medium text-lg">
                    Pilih kendaraan yang tersedia di bawah ini untuk mendukung mobilitas Anda.
                </p>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-slate-100 text-slate-600 rounded-xl flex items-center justify-center shadow-inner">
                        <i class="fas fa-list-ul"></i>
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-900 tracking-tight">Daftar Kendaraan Tersedia</h3>
                </div>
                <span class="bg-blue-50 text-blue-700 text-sm font-bold px-4 py-1.5 rounded-xl border border-blue-200 shadow-sm flex items-center gap-2">
                    <i class="fas fa-info-circle"></i> {{ count($availableVehicles) }} Tersedia
                </span>
            </div>
            
            @if(count($availableVehicles) > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Detail Kendaraan</th>
                                <th class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Merek & Tahun</th>
                                <th class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Kode</th>
                                <th class="px-8 py-5 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">Otorisasi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-100">
                            @foreach($availableVehicles as $vehicle)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-14 w-14 rounded-2xl bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400">
                                            <i class="fas fa-car text-2xl"></i>
                                        </div>
                                        <div class="ml-5">
                                            <div class="text-base font-bold text-slate-900">{{ $vehicle->name }}</div>
                                            <div class="text-sm text-slate-500 font-mono mt-1 bg-slate-100 inline-block px-2 py-0.5 rounded"><i class="fas fa-hashtag text-slate-400 mr-1 text-[10px]"></i>{{ $vehicle->plate_number }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <div class="text-base font-bold text-slate-800">{{ $vehicle->brand }}</div>
                                    <div class="text-sm font-medium text-slate-500 mt-1 flex items-center"><i class="far fa-calendar-alt text-slate-400 mr-1.5"></i>{{ $vehicle->year }}</div>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-bold bg-slate-100 text-slate-700 border border-slate-200 shadow-sm">
                                        {{ $vehicle->vehicle_code }}
                                    </span>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap text-right">
                                    <form action="{{ route('member.borrow.store') }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
                                        @if($hasActiveTransaction)
                                            <button type="button" class="inline-flex items-center justify-center px-5 py-2.5 bg-slate-100 text-slate-400 font-bold rounded-xl cursor-not-allowed border border-slate-200" disabled title="Selesaikan transaksi aktif Anda terlebih dahulu">
                                                <i class="fas fa-lock mr-2"></i> Pinjam
                                            </button>
                                        @else
                                            <button type="submit" class="inline-flex items-center justify-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition-all shadow-md shadow-blue-600/20 hover:shadow-lg hover:shadow-blue-600/30 transform hover:-translate-y-0.5 duration-200">
                                                <i class="fas fa-key mr-2"></i> Pinjam
                                            </button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-20 text-center">
                    <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 border-2 border-slate-100 shadow-inner">
                        <i class="fas fa-car-slash text-4xl text-slate-300"></i>
                    </div>
                    <h3 class="text-2xl font-extrabold text-slate-900 mb-3 tracking-tight">Semua Kendaraan Sedang Digunakan</h3>
                    <p class="text-slate-500 max-w-md mx-auto font-medium text-lg">Mohon maaf, saat ini seluruh aset kendaraan sedang dalam pemakaian. Silakan cek kembali nanti.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
