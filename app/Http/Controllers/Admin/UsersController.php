<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Usertype;
use App\Models\Vehicle;
use App\Models\Vehicleoccupant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       /*$users = User::all();
        return view('admin.users.index', compact('users'));

        */
        $users = User::select(
            'users.id', 
            //'users.name', 
             DB::raw('CONCAT(users.name, \' \', users.lastname) as fullname'),
            'users.dni', 
            'users.email', 
            't.name as types', 
            )
            ->join('usertypes as t','users.usertype_id','=','t.id')->get();
        return view('admin.users.index', compact('users'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usertype = Usertype::pluck('name', 'id');
        
        //$users = User::pluck('name','id');
        return view('admin.users.create', compact('usertype'));    

    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        //return $request->all();
        $d = $request->password;
        $request['password'] = Hash::make($d);
        User::create($request->all());
        return redirect()->route('admin.users.index')->with('success', 'Persona registrada');
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
        $users = User::find($id);
        $usertype = Usertype::pluck('name','id');
        return view('admin.users.edit', compact('users','usertype'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users = User::find($id);
        $vehicles = Vehicleoccupant::where('user_id', $id)->count();

        if ($vehicles > 0) {
            return redirect()->route('admin.users.index')->with('error', 'Persona esta asociado a vehiculo');
        } else {
            $users->delete();
            return redirect()->route('admin.users.index')->with('Success', 'Persona eliminada');
        }
    }
}
