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
            return redirect()->route('login.page')->with('error', 'Invalid username');
        }

        if (!Hash::check($request['password'], $user->password)) {
            return redirect()->route('login.page')->with('error', 'Invalid password');
        }

        // إنشاء التوكن
        $token = $user->createToken('myapptoken')->plainTextToken;

        // تخزين التوكن في الجلسة
        session(['auth_token' => $token]);

        return redirect()->route('category.page')->with('success', 'Login successful');
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        if ($user) {
            $user->tokens()->delete(); // حذف جميع التوكنات
        }

        session()->forget('auth_token'); // حذف التوكن من الجلسة

        return redirect()->route('login.page')->with('success', 'Logged out successfully');
    }
}
