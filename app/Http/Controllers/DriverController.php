<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drivers = Driver::paginate('15');
        return view('drivers.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('drivers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'mobile' => 'required',
       ]);
       $driver = new Driver();
       $driver->name=$request->name;
       $driver->mobile=$request->mobile;
       $driver->save();

       return redirect()->route('drivers.index')->with('success','driver added sucessfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $driver = Driver::find($id);
        return view('drivers.edit', compact('driver'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Driver $driver)
    {
        $this->validate($request,[
            'name' => 'required',
            'mobile' => 'required',
       ]);
       $driver->name=$request->name;
       $driver->mobile=$request->mobile;
       $driver->save();

       return redirect()->route('drivers.index')->with('success','driver updated sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $driver = Driver::find($id);
        $driver->delete();
        return redirect()->route('drivers.index')->with('success','driver deleted sucessfully');
    }
}
