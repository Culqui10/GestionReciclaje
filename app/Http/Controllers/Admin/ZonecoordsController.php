<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use App\Models\Zonecoord;
use Illuminate\Http\Request;

class ZonecoordsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //return view('admin.zonecoords.create');

    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $zoneId = $request->input('zone_id');
        $coordinates = [];

        for ($i = 1; $i <= $request->input('coordinate_count'); $i++) {
            $coordinates[] = [
                'latitude' => $request->input('latitude' . $i),
                'longitude' => $request->input('longitude' . $i),
                'zone_id' => $zoneId
            ];
        }
        foreach ($coordinates as $coord) {
            Zonecoord::create($coord);
        }
        return redirect()->route('admin.zones.show', $zoneId)->with('success', 'Coordenadas agregadas');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $zone = Zone::find($id);
        $lastcoord = Zonecoord::select('latitude as lat', 'longitude as lng')
            ->where('zone_id', $id)->latest()->first();

        $vertice = Zonecoord::select('latitude as lat', 'longitude as lng')
            ->where('zone_id', $id)->get();

        return view('admin.zonecoords.create', compact('zone', 'lastcoord', 'vertice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $zone = Zone::find($id);
        if (!$zone) {
            return redirect()->route('admin.zones.index')->with('error', 'Zona no encontrada');
        }

        $coordCount = Zonecoord::where('zone_id', $id)->count();

        if ($coordCount > 0) {
            Zonecoord::where('zone_id', $id)->delete();
            return redirect()->route('admin.zones.show', $id)->with('success', 'Coordenadas eliminadas');
        } else {
            return redirect()->route('admin.zones.show', $id)->with('error', 'La zona no tiene coordenadas registradas');
        }
    }
}
