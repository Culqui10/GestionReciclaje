<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ZonesController extends Controller
{
    public function listar()
    {

        try {
            $zonas = Zone::select('id', 'name')->get();
            if (!$zonas->isEmpty()) {
                return response()->json(['status' => true, 'data' => $zonas, 'message' => 'Listado de zonas'], 200);
            } else {
                return response()->json(['status' => false, 'data' => [], 'message' => 'No hay ninguna zona registrada'], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error del servidor',
                'errors' => $e->getMessage(),
            ], 500);
        }
    }
    public function obtenerzona(Request $request)
    {
        try {
            $zone = DB::select('
            SELECT id,latitude,longitude
            FROM zonecoords zc
            WHERE zone_id=?', [$request->zone_id]);
            return response()->json(['status' => true, 'data' => $zone, 'message' => 'Zona obtuvida'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error del servidor',
                'errors' => $e->getMessage(),
            ], 500);
        }
    }
}
