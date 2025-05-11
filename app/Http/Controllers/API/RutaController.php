<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RutaController extends Controller
{
    public function ruta(Request $request)
    {
        try {
            $route = DB::select('
        SELECT r.id,latitudestart,longitudestart,longitudefinal,latitudefinal,rz.zone_id
        FROM routes r
        INNER JOIN routezones  rz ON r.id=rz.route_id
        WHERE rz.route_id=?', [$request->ruta_id]);
            return response()->json(['status' => true, 'data' => $route, 'message' => 'Listado de zonas'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error del servidor',
                'errors' => $e->getMessage(),
            ], 500);
        }
    }
    public function consultarrutas(Request $request)
    {
        try {
            $routes = DB::select('
        SELECT vr.id,r.name,vr.date_route,p.starttime,vr.route_id,rz.zone_id,CONCAT(v.name," DE COLOR ",color_id, " CON PLACA ",plate) AS vehicle,rs.name as estado
        FROM vehicleroutes vr
        INNER JOIN programmings p ON vr.programming_id=p.id
        INNER JOIN routes r ON vr.route_id=r.id
        INNER JOIN routezones rz ON r.id=rz.route_id
        INNER JOIN vehicles v ON vr.vehicle_id=v.id
        INNER JOIN vehiclecolors vc ON v.color_id=vc.id
        inner join routestatus rs on vr.routestatus_id=rs.id
        WHERE date_route BETWEEN ? AND ?
        AND r.status="1" AND rz.zone_id=?', [$request->txtFechainicial, $request->txtFechafinal, $request->zone_id]);
            return response()->json(['status' => true, 'data' => $routes, 'message' => 'Listado de zonas'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error del servidor',
                'errors' => $e->getMessage(),
            ], 500);
        }
    }
    public function rutahoy(Request $request)
    {
        try {
            $route = DB::select('
        SELECT latitudestart,longitudestart,longitudefinal,latitudefinal
        FROM routes r
        INNER JOIN routezones  rz ON r.id=rz.route_id
        INNER JOIN vehicleroutes vr ON r.id=vr.route_id
        WHERE rz.zone_id=? AND routestatus_id=1 AND date_route=CURDATE() LIMIT 1', [$request->zone_id]);
            return response()->json(['status' => true, 'data' => $route, 'message' => 'Listado de zonas'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error del servidor',
                'errors' => $e->getMessage(),
            ], 500);
        }
    }
}