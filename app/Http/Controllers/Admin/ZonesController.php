<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use App\Models\Zonecoord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ZonesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $zones = Zone::all();

        $zonesMap = DB::table('zones')
            ->leftJoin('zonecoords', 'zones.id', '=', 'zonecoords.zone_id')
            ->select('zones.name as zone', 'zonecoords.latitude', 'zonecoords.longitude')
            ->get();

        // Agrupa las coordenadas por zona
        $groupedZones = $zonesMap->groupBy('zone');

        $perimeter = $groupedZones->map(function ($zone) {
            $coords = $zone->map(function ($item) {
                return [
                    'lat' => $item->latitude,
                    'lng' => $item->longitude,
                ];
            })->toArray();
            return [
                'name' => $zone[0]->zone, // Cambiar 'zone' por 'name'
                'coords' => $coords,
            ];
        })->values(); // Reindexar las claves numéricas del resultado

        return view('admin.zones.index', compact('zones', 'perimeter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.zones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Zone::create($request->all());
        return redirect()->route('admin.zones.index')->with('success', 'Zona registrada!');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $zone = Zone::find($id);
        $coords = Zonecoord::where('zone_id', $id)->get();

        $perimeter = $coords->map(function ($coord) {
            return [
                'lat' => $coord->latitude,
                'lng' => $coord->longitude,
            ];
        })->toArray();

        return view('admin.zones.show', compact('zone', 'coords', 'perimeter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $zone = Zone::find($id);
        return view('admin.zones.edit', compact('zone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $zone = Zone::find($id);
        $zone->update($request->all());

        return redirect()->route('admin.zones.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $zones = Zone::find($id);
        $coord = Zonecoord::where('zone_id', $id)->count();
        if ($coord > 0) {
            return redirect()->route('admin.zones.index')->with('error', 'Zona tiene coordenadas');
        } else {
            $zones->delete();
            return redirect()->route('admin.zones.index')->with('success', 'Zona eliminada');
        }
    }
}
