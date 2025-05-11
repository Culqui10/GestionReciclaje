<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Brandmodel;
use Illuminate\Http\Request;

class BrandmodelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$models = Brandmodel::all();
        
        $models = Brandmodel::select(
            'brandmodels.id', 
            'brandmodels.name', 
            'b.name as brandname', 
            'brandmodels.code', 
            'brandmodels.description'
            )
            ->join('brands as b','brandmodels.brand_id','=','b.id')->get();
        return view('admin.models.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::pluck('name','id');
        return view('admin.models.create', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Brandmodel::create($request->all());
        return redirect()->route('admin.models.index')->with('success', 'modelo registrado');
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
        $model = Brandmodel::find($id);
        $brands = Brand::pluck('name','id');
        return view('admin.models.edit', compact('model','brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $model = Brandmodel::find($id);
        $model->update($request->all());
        //$brands = Brand::pluck('name','id');
        return redirect()->route('admin.models.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Brandmodel::find($id);
        $model->delete();
        return redirect()->route('admin.models.index')->with('success','Modelo eliminada');
    }

    public function modelsbybrand(String $id){
        $models = Brandmodel::where('brand_id', $id)->get();
        return $models;
    }
}
