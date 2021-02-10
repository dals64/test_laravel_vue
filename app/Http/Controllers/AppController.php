<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AppController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json(['user' => Auth::user()], 200);
        }else{
            return response()->json(['error' => 'Could not log you in'], 401);
        }
        
    }

    public function register(Request $request)
    {
        $user = User::where('email', $request->username)->first();
        if (isset($user->id)) {
            return response()->json(['error' => 'Email already exists'], 401);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        Auth::login($user);

        return response()->json(['user' => $user], 200);
    }

    public function logout()
    {
        Auth::logout();
    }
}
