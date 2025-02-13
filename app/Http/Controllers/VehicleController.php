<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::paginate('15');
        return view('vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $this->validate($request,[
            'name' => 'required',
            'number' => 'required',
       ]);
       $vehicle = new Vehicle();
       $vehicle->name=$request->name;
       $vehicle->number=$request->number;
       $vehicle->save();

       return redirect()->route('vehicles.index')->with('success','vehicle created sucessfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $vehicle = Vehicle::find($id);
        return view('vehicles.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $this->validate($request,[
            'name' => 'required',
            'number' => 'required',
       ]);
       $vehicle->name=$request->name;
       $vehicle->number=$request->number;
       $vehicle->save();

       return redirect()->route('vehicles.index')->with('success','vehicle updated sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::find($id);
        $vehicle->delete();
        return redirect()->route('vehicles.index')->with('success','vehicle deleted sucessfully');

    }
}
