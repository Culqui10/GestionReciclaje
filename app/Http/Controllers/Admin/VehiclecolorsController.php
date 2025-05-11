<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\Vehiclecolor;
use Illuminate\Http\Request;

class VehiclecolorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colors = Vehiclecolor::all();
        return view('admin.colors.index', compact('colors'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.colors.create');
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        $code_color = Vehiclecolor::where('color_code', $request->color_code)->first();

        if ($code_color) {
            return redirect()->route('admin.colors.index')->with('error', 'Color ya existe');
        } else {
            Vehiclecolor::create($request->except('hex_code'));
            return redirect()->route('admin.colors.index')->with('success', 'Color registrado');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $colors = Vehiclecolor::find($id);
        return view('admin.colors.edit', compact('colors'));
    }

    /**
     * Update the specified resource in storage.
     */
    /*
    public function update(Request $request, string $id)
    {
        $code_color = Vehiclecolor::where('color_code', $request->color_code)->first();

        if ($code_color) {
            return redirect()->route('admin.colors.index')->with('error', 'Color ya existe');
        } else {
            $colors = Vehiclecolor::find($id);
            $colors->update($request->except('hex_code'));
            return redirect()->route('admin.colors.index')->with('success', 'Color actualizado');
        }

    }
        */
    public function update(Request $request, string $id)
    {
        $colors = Vehiclecolor::find($id);
        $code_color = Vehiclecolor::where('color_code', $request->color_code)->where('id', '!=', $id)->first();

        if ($code_color) {
            return redirect()->route('admin.colors.index')->with('error', 'Color ya existe');
        }

        $colors->update($request->except('hex_code'));
        return redirect()->route('admin.colors.index')->with('success', 'Color actualizado');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        /*
        $colors = Vehiclecolor::find($id);
        $colors->delete();
        return redirect()->route('admin.colors.index')->with('success','Color de vehiculo eliminado');

        */

        $colors = Vehiclecolor::find($id);
        $vehicles = Vehicle::where('color_id', $id)->count();
        if ($vehicles > 0) {
            return redirect()->route('admin.colors.index')->with('error', 'Color contiene vehiculos');
        } else {
            $colors->delete();
            return redirect()->route('admin.colors.index')->with('Success', 'Color de vehiculo eliminado');
        }
    }

    private function hexToRgb($hex)
    {
        $hex = str_replace('#', '', $hex);

        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        return "$r, $g, $b";
    }
    private function rgbToHex($rgb)
    {
        $rgbArray = explode(', ', $rgb);
        $hex = "#";
        foreach ($rgbArray as $value) {
            $hex .= str_pad(dechex($value), 2, '0', STR_PAD_LEFT);
        }
        return $hex;
    }
}
