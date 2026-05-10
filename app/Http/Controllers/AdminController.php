<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Vehicles;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
       
        $availableVehicles = Vehicles::where('status', 'available')->count();

       
        $totalTransactions = Transaction::count();

        
        $registeredUsers = User::where('role', '!=', 'admin', )->count();

        return view('admin.dashboard', compact(
            'availableVehicles',
            'totalTransactions',
            'registeredUsers'
        ));
    }
}