<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterUserController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:6',
                'phone' => 'required|string|digits:9',
                'address' => 'required|string',
                'zone_id' => 'required|integer',
            ]);

            $user = DB::table('users')->insert([
                'name' => $request->name,
                'lastname' => $request->last_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'address' => $request->address,
                'phone' => $request->phone,
                'zone_id' => $request->zone_id,
                'usertype_id' => 2,
            ]);

            if($user){
                return response()->json(['status' => true, 'data' => [], 'message' => 'Usuario registrado correctamente'], 200);
            } else {
                return response()->json(['status' => false, 'data' => [], 'message' => 'No se pudo registrar el usuario'], 400);
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error del servidor',
                'errors' => $e->getMessage(),
            ], 500);
        }
    }
}
