<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vechicletype;
use App\Models\Vehicle;
use App\Models\Vehicletype;
use Illuminate\Http\Request;

class VehicletypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Vehicletype::all();
        return view('admin.types.index', compact('types'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Vehicletype::create($request->all());
        return redirect()->route('admin.types.index')->with('success', 'Tipo de vehiculo registrado');
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
    public function edit(string $id)
    {
        $types = Vehicletype::find($id);
        return view('admin.types.edit', compact('types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $types = Vehicletype::find($id);
        $types->update($request->all());
        return redirect()->route('admin.types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $types = Vehicletype::find($id);
        $vehicles = Vehicle::where('type_id',$id)->count();
        if($vehicles > 0){
            return redirect()->route('admin.types.index')->with('error','Tipo contiene vehiculos');
        }else{
            $types->delete();
            return redirect()->route('admin.types.index')->with('Success','Tipo de vehiculo eliminado');
            
        }
    }
}
