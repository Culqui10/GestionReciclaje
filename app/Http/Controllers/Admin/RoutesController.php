<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Route;
use App\Models\Routezone;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoutesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $routes = DB::select("
        SELECT 
            routes.id, 
            routes.name,
            routes.latitudestart,
            routes.longitudestart,
            routes.latitudefinal,
            routes.longitudefinal,
            CASE 
                WHEN routes.status = 1 THEN 'Activo' 
                ELSE 'Inactivo' 
            END AS status
        FROM routes 
    ");

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
                'name' => $zone[0]->zone,
                'coords' => $coords,
            ];
        })->values();

        // Mapear las rutas con sus coordenadas de inicio y final
        $routesWithCoords = collect($routes)->map(function ($route) {
            return [
                'name' => $route->name,
                'start' => [
                    'lat' => $route->latitudestart,
                    'lng' => $route->longitudestart,
                ],
                'end' => [
                    'lat' => $route->latitudefinal,
                    'lng' => $route->longitudefinal,
                ],
            ];
        });

        return view('admin.routes.index', compact('routes', 'perimeter', 'routesWithCoords'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $zones = Zone::all();

        $zonesMap = DB::table('zones')
            ->leftJoin('zonecoords', 'zones.id', '=', 'zonecoords.zone_id')
            ->select('zones.name as zone', 'zonecoords.latitude', 'zonecoords.longitude')
            ->get();

        // Agrupar coordenadas por zona
        $groupedZones = $zonesMap->groupBy('zone');

        $perimeter = $groupedZones->map(function ($zone) {
            $coords = $zone->map(function ($item) {
                return [
                    'lat' => $item->latitude,
                    'lng' => $item->longitude,
                ];
            })->toArray();

            return [
                'name' => $zone[0]->zone,
                'coords' => $coords,
            ];
        })->values();

        return view('admin.routes.create', compact('zones', 'perimeter'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            //'zone_id' => 'required|exists:zones,id',
            'status' => 'nullable|boolean',
            'latitudestart' => 'required|numeric',
            'longitudestart' => 'required|numeric',
            'latitudefinal' => 'required|numeric',
            'longitudefinal' => 'required|numeric',
        ]);

        $route = new Route();
        $route->name = $data['name'];
        //$route->zone_id = $data['zone_id'];
        $route->status = $request->has('status');
        $route->latitudestart = $data['latitudestart'];
        $route->longitudestart = $data['longitudestart'];
        $route->latitudefinal = $data['latitudefinal'];
        $route->longitudefinal = $data['longitudefinal'];
        $route->save();

        return redirect()->back()->with('success', 'Ruta creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $route = Route::findOrFail($id);

        $routezones = DB::select('
            SELECT rz.id, z.name 
            FROM routezones rz 
            INNER JOIN zones z ON rz.zone_id = z.id 
            WHERE rz.route_id = ?', [$id]);

        $zonesMap = DB::table('zones')
            ->leftJoin('zonecoords', 'zones.id', '=', 'zonecoords.zone_id')
            ->whereIn('zones.id', function ($query) use ($id) {
                $query->select('zone_id')
                    ->from('routezones')
                    ->where('route_id', $id);
            })
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
                'name' => $zone[0]->zone,
                'coords' => $coords,
            ];
        })->values();

        return view('admin.routes.show', compact('route', 'routezones', 'perimeter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $route = Route::find($id);
        //$zones = Zone::pluck('name','id');

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
                'name' => $zone[0]->zone,
                'coords' => $coords,
            ];
        })->values();

        return view('admin.routes.edit', compact('route', 'zones', 'perimeter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            //'zone_id' => 'required|exists:zones,id',
            'status' => 'nullable|boolean',
            'latitudestart' => 'required|numeric',
            'longitudestart' => 'required|numeric',
            'latitudefinal' => 'required|numeric',
            'longitudefinal' => 'required|numeric',
        ]);

        $route = Route::findOrFail($id);
        $route->name = $data['name'];
        //$route->zone_id = $data['zone_id'];
        $route->status = $request->has('status');
        $route->latitudestart = $data['latitudestart'];
        $route->longitudestart = $data['longitudestart'];
        $route->latitudefinal = $data['latitudefinal'];
        $route->longitudefinal = $data['longitudefinal'];
        $route->save();

        return redirect()->back()->with('success', 'Ruta actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $route = Route::find($id);
        $routezone = Routezone::where('route_id', $id)->count();
        if ($routezone > 0) {
            return redirect()->route('admin.routes.index')->with('error', 'Ruta tiene zonas registradas');
        } else {
            $route->delete();
            return redirect()->route('admin.routes.index')->with('success', 'Ruta eliminada');
        }
    }
}
