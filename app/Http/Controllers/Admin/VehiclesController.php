<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Brandmodel;
use App\Models\Occupant;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Vehiclecolor;
use App\Models\Vehicleimage;
use App\Models\Vehicleoccupant;
use App\Models\Vehicletype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VehiclesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = DB::select("
        SELECT v.id,vi.image,v.name AS vname,b.name AS bname,bm.name AS bmname,vt.name AS vtname,v.plate
            FROM vehicles v INNER JOIN brands b ON v.brand_id=b.id
            INNER JOIN brandmodels bm ON v.brand_id=bm.id
            INNER JOIN vehicletypes vt ON v.type_id=vt.id
            LEFT JOIN vehicleimages vi ON (vi.vehicle_id=v.id AND vi.profile=1)
        ");
        return view('admin.vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brandSQL = Brand::whereRaw('id IN (SELECT brand_id FROM brandmodels)')->get();
        $brands = Brand::pluck('name', 'id');
        $models = Brandmodel::where('brand_id', $brandSQL->first()->id)->pluck('name', 'id');
        $types = Vehicletype::pluck('name', 'id');
        $colors = Vehiclecolor::all();
        return view('admin.vehicles.create', compact('brands', 'models', 'types', 'colors'));
        //return view('admin.vehicles.create', compact('brands', 'models', 'types', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /*$request->validate([
            'name' => 'unique:vehicles',
            'code' => 'unique:code',
            'plate' => 'unique:plate'
        ]);*/
        $status=0;

        if (isset($request->status)) {
            $status = 1;
        }
        $vehicle = Vehicle::create($request->except('image','user_id') + ['status'=>$status] );

        if($request->image){ 
            $image = $request->file('image')->store('public/vehicles_images');
            $urlImage = Storage::url($image);
            Vehicleimage::create([
                'image'=>$urlImage,
                'profile'=>'1',
                'vehicle_id'=> $vehicle->id
            ]);
        }
        return redirect()->route('admin.vehicles.index')->with('success', 'Vehiculo registrada!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vehicle=Vehicle::find($id);
        $occupant = DB::select("
            SELECT 
                o.id, 
                CONCAT(u.name, ' ', u.lastname) AS usernames, 
                ut.name AS usertype, 
                o.assignment_date AS date
            FROM vehicleoccupants o  
            INNER JOIN vehicles v ON o.vehicle_id = v.id
            INNER JOIN users u ON o.user_id = u.id
            INNER JOIN usertypes ut ON o.usertype_id = ut.id
            WHERE o.status = 1
            AND v.id = ?
            ", [$id]);
        return view('admin.vehicles.show', compact('vehicle','occupant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vehicle = Vehicle::find($id);
        $brands = Brand::pluck('name','id');
        $models = Brandmodel::pluck('name','id');
        $types = Vehicletype::pluck('name','id');
        //$colors = Vehiclecolor::pluck('name','id');
        $colors = Vehiclecolor::all();
        //$model = Brandmodel::find($id);
        return view('admin.vehicles.edit', compact('vehicle','brands','models','types','colors'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vehicle = Vehicle::find($id);
        if ($request->image) {
            Vehicleimage::where('vehicle_id', $id)->delete();
            $image = $request->file('image')->store('public/vehicles_images');
            $urlImage = Storage::url($image);
            Vehicleimage::create([
                'image' => $urlImage,
                'profile' => '1',
                'vehicle_id' => $id
            ]);
        }
        $vehicle->update($request->except('image'));
        return redirect()->route('admin.vehicles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Vehicleoccupant::where('vehicle_id', $id)->delete();
        Vehicleimage::where('vehicle_id', $id)->delete();
        $vehicles = Vehicle::find($id);
        $vehicles->delete();
        return redirect()->route('admin.vehicles.index')->with('success', 'Vehiculo eliminado');
    }

    
    
}