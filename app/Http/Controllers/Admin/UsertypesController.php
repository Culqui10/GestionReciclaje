<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Usertype;
use Illuminate\Http\Request;

class UsertypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usertypes = Usertype::all();
        return view('admin.Usertypes.index', compact('usertypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Usertypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Usertype::create($request->all());
        return redirect()->route('admin.Usertypes.index')->with('success', 'Tipo de persona registrada');
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
        $usertype = Usertype::find($id);
        return view('admin.Usertypes.edit', compact('usertype'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $usertype = Usertype::find($id);
        $usertype->update($request->all());
        return redirect()->route('admin.Usertypes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usertype = Usertype::find($id);

        $users = User::where('usertype_id',$id)->count();

        if($users > 0){
            return redirect()->route('admin.Usertypes.index')->with('error','Tipo contiene personas asociadas');
        }else{
            $usertype->delete();
            return redirect()->route('admin.Usertypes.index')->with('Success','Tipo de persona eliminada');
            
        }
    }
}
