<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Traits\GeneralTrait;

class LoginController extends Controller
{
    use GeneralTrait;
    public function login(LoginRequest $request)
    {


        $user = User::where('name', $request['name'])->first();
        if (!$user) {
            return response([
                'message' => 'name field incorrect'
            ], 401);
        } else if (!Hash::check($request['password'], $user->password)) {
            return response([
                'message' => 'password field incorrect'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;
        return response()->json([
            'message' => 'Login successfully',
            'token' => $token
        ], 200);    }
    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
        return $this->returnSuccessMessage(" logout successfully");
    }
}
