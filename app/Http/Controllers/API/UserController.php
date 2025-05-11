<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credenciales = $request->only('email', 'password');
        $user = User::where('email', $credenciales['email'])->first();

        if ($user) {
            if (Auth::attempt($credenciales)) {
                $zone = DB::table('zones')->where('id', $user->zone_id)->first()->name;
                $token = $user->createToken('api-token')->plainTextToken;
                $user->token = $token;
                $user->zone = $zone;
                return response()->json(['status' => true, 'data' => $user, 'message' => 'Credenciales correctas, bienvenido a la aplicacion'], 200);
            } else {
                return response()->json(['status' => false, 'data' => [], 'message' => 'Contraseña incorrecta'], 400);
            }
        } else {
            return response()->json(['status' => false, 'data' => [], 'message' => 'Usuario no encontrado'], 400);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['status' => true, 'data' => [], 'message' => 'logged out'], 200);
    }
}
