<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Usertype;
use App\Models\Vehicle;
use App\Models\Vehicleoccupant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleOccupantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $vehicleoccupants = DB::select("
            SELECT 
                o.id, 
                u.name AS uname, 
                ut.name AS utname, 
                v.name AS vname, 
                CASE 
                    WHEN o.status = 1 THEN 'Activo' 
                    ELSE 'Inactivo' 
                END AS status, 
                o.assignment_date
            FROM vehicleoccupants o  
            INNER JOIN vehicles v ON o.vehicle_id = v.id
            INNER JOIN users u ON o.user_id = u.id
            INNER JOIN usertypes ut ON o.usertype_id = ut.id
        ");

        return view('admin.occupants.index', compact('vehicleoccupants'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
