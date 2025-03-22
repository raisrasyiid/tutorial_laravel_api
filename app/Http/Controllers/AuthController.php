<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request){

        //cek validate form
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //cek model
        $user = User::where('email', $request->email)->first();

        //cek data user dari model
    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    //create token
    $token = $user->createToken('userLogin')->plainTextToken;

    return response()->json([
        'status' => 'Login successfully',
        'message' => 'Token : ' . $token
    ], 200);

    }

    public function logout(Request $request){
        $token = $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout successfully' . $token
        ], 200);
    }

    public function userLogin(Request $request){
        return response()->json(Auth::user());
    }
}
