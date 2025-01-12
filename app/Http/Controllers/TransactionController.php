<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Vehicles;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $transactions = Transaction::with(['user', 'vehicle'])->get();
            return view('admin.transactions.index', compact('transactions'));
        } else {
            // For member dashboard
            $transactions = Transaction::with(['user', 'vehicle'])
                ->where('user_id', auth()->id())
                ->get();
            return view('member.dashboard', compact('transactions'));
        }
    }

    public function create()
    {
        $vehicles = Vehicles::where('status', 'available')->get();
        $users = User::where('role', 'member')->get();
        return view('admin.transactions.create', compact('vehicles', 'users'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'borrow_date' => 'required|date',
            'return_date' => 'required|date|after:borrow_date',
            'status' => 'required|in:pending,ongoing,completed'
        ]);
    
        // Temukan kendaraan berdasarkan vehicle_id
        $vehicle = Vehicles::findOrFail($validated['vehicle_id']);
        
        // Pastikan kendaraan tersedia
        if ($vehicle->status !== 'available') {
            return back()->with('error', 'Kendaraan tidak tersedia');
        }
    
        // Buat transaksi baru
        $transaction = Transaction::create($validated);
    
        // Ubah status kendaraan menjadi 'borrowed'
        $vehicle->update(['status' => 'borrowed']);
    
        // Redirect kembali ke halaman admin.transactions.index dengan success message
        return redirect()->route('admin.transactions.index')
            ->with('success', 'Transaksi berhasil ditambahkan')
            ->with('newTransaction', $transaction);
    }


    public function show(Transaction $transaction)
    {
        $transaction->load(['user', 'vehicle']);
        return view('admin.transactions.show', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,ongoing,completed'
        ]);

        // Update vehicle status based on transaction status
        if ($validated['status'] === 'completed') {
            $transaction->vehicle->update(['status' => 'available']);
        } elseif ($validated['status'] === 'ongoing') {
            $transaction->vehicle->update(['status' => 'borrowed']);
        }

        $transaction->update($validated);
        return redirect()->route('admin.transactions.index')->with('success', 'Status transaksi berhasil diupdate');
    }

    public function destroy(Transaction $transaction)
{
    // Update vehicle status to available before deleting transaction
    $transaction->vehicle->update(['status' => 'available']);
    
    // Delete the transaction
    $transaction->delete();

    return redirect()->route('admin.transactions.index')->with('success', 'Transaksi berhasil dihapus');
}

}