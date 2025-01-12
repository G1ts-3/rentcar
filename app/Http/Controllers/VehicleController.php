<?php

namespace App\Http\Controllers;

use App\Models\Vehicles;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicle = Vehicles::all();
        return view('admin.vehicles.index', compact('vehicle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'vehicle_code' => 'required|unique:vehicles',
        'brand' => 'required',
        'name' => 'required',
        'plate_number' => 'required|unique:vehicles,plate_number',
        'year' => 'required|numeric',
        'status' => 'required|in:available,borrowed,maintenance'
    ]);

    // Create the vehicle if validation passes
    Vehicles::create($validated);

    return redirect()->route('admin.vehicles.index')->with('success', 'Kendaraan berhasil ditambahkan');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicles $vehicle)
    {
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicles $vehicle)
    {
        $validated = $request->validate([
            'vehicle_code' => 'required|unique:vehicles,vehicle_code,' . $vehicle->id,
            'brand' => 'required',
            'name' => 'required',
            'plate_number' => 'required|unique:vehicles,plate_number,' . $vehicle->id,
            'year' => 'required|numeric',
            'status' => 'required|in:available,borrowed,maintenance'
        ]);

        $vehicle->update($validated);
        return redirect()->route('admin.vehicles.index')->with('success', 'Kendaraan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicles $vehicle)
    {
        // Check if vehicle is currently in use
        if ($vehicle->transaction()->where('status', 'borrowed')->exists()) {
            return back()->with('error', 'Kendaraan sedang dipinjam dan tidak dapat dihapus');
        }
        

        $vehicle->delete();
        return redirect()->route('admin.vehicles.index')->with('success', 'Kendaraan berhasil dihapus');
    }

}
