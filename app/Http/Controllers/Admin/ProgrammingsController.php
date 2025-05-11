<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Programmin;
use App\Models\Programming;
use App\Models\Route;
use App\Models\Routestatu;
use App\Models\Vehicle;
use App\Models\Vehicleroutes;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime, DateInterval, DatePeriod;

class ProgrammingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::pluck('name', 'id');
        $routes = Route::pluck('name', 'id');
        $programmings = [];

        return view('admin.programming.index', compact('programmings', 'vehicles', 'routes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $routes = Route::pluck('name', 'id');
        return view('admin.programming.create', compact('routes'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request){
        $p = [
            'startdate' => $request->startdate,
            'lastdate' => $request->lastdate,
            'vehicle_id' => $request->vehicle_id,
            'route_id' => $request->route_id
        ];
        if ($this->searchifexist($p) == 0) {
            $p = Programming::create([
                'startdate' => $request->startdate,
                'lastdate' => $request->lastdate,
                'starttime' => $request->starttime
            ]);

            $begin = new DateTime($request->startdate);
            //$end = new DateTime($request->lastdate);
            $fechafinal = date($request->lastdate);
            $final = date("d-m-Y", strtotime($fechafinal . '+ 1 days'));

            // echo $final;

            $interval = DateInterval::createFromDateString('1 day');
            $period = new DatePeriod($begin, $interval, new DateTime($final));

            foreach ($period as $dt) {
                Vehicleroutes::create([
                    'date_route' => $dt->format("Y-m-d"),
                    'description' => '',
                    'vehicle_id' => $request->vehicle_id,
                    'route_id' => $request->route_id,
                    'routestatus_id' => 1,
                    'programming_id' => $p->id
                ]);
            }

            return redirect()->route('admin.programming.index')->with('success', 'Programacion registrada'); 
        } else {
            return redirect()->route('admin.programming.index')->with('error', 'Ya existe una programación con entre esos días, ruta y vehículo, por favor verifique');
        }
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
        $vr = Vehicleroutes::find($id);
        $vehicles = Vehicle::pluck('name', 'id');
        $routes = Route::pluck('name', 'id');
        $routestatus = Routestatu::pluck('name', 'id');
        return view('admin.programming.edit', compact('vr', 'vehicles', 'routes', 'routestatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vr = Vehicleroutes::find($id);
        $vr->update($request->all());
        return redirect()->route('admin.programming.index')->with('success', 'Programacion actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $programming = Vehicleroutes::find($id);
        $programming->delete();
        return redirect()->route('admin.programming.index')->with('success', 'Programacion eliminada');
    }

    public function searchprogramming(Request $request)
    {
        $listado = DB::select(
            'select vr.id,vr.date_route as fecha,rs.name as estado,v.name as vehiculo,r.name as ruta,vr.description
        from vehicleroutes vr
        inner join routes r on vr.route_id=r.id
        inner join vehicles v on vr.vehicle_id=v.id
        inner join programmings p on vr.programming_id=p.id 
        inner join routestatus rs on vr.routestatus_id=rs.id
        where vr.vehicle_id=? and vr.route_id=? and vr.date_route between ? and ? ',
            [
                $request->vehicle_id, $request->route_id, $request->startdate, $request->lastdate,
            ]
        );
        // $listado=[];
        return view('admin.programming.list', compact('listado'));
    }
    public function searchifexist($p)
    {
        $programacion = DB::select(
            'select * from vehicleroutes where vehicle_id=? and route_id=? and date_route between ? and ?',
            [
                $p['vehicle_id'],
                $p['route_id'],
                $p['startdate'],
                $p['lastdate']
            ]
        );
        $exist = count($programacion);
        if ($exist > 0) {
            return 1;
        } else {
            return 0;
        }
    }
}
