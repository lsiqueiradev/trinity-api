<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function sessionsValidate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'email' => 'required|string|email',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::where('email', $request->email)->first();
        if(!$user){
            return response()->json([
                'message' => 'user not found',
                'status' => 1, // 1 = user create, 2 = user email login, 3 = user provider login
            ], 200);
        }
        if ($user->provider_name == 'email') {
            return response()->json([
                'message' => 'user logged with email',
                'status' => 2, // 1 = user create, 2 = user email login, 3 = user provider login
            ], 200);
        } else {
            return response()->json([
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'avatar_url' => $user->avatar_url,
                    'provider_name' => $user->provider_name,
                ],
                'message' => 'user logged with provider',
                'status' => 3, // 1 = user create, 2 = user email login, 3 = user provider login
            ], 200);
        }
    }

    public function sessionsProvider(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if($user) {
            $token = Auth::login($user);
            return response()->json([
                'user' => $user,
                'token' => $token,
            ]);
        } else {
            $user = User::create([
                'email' => $request->email,
                'name' => $request->name,
                'provider_token' => $request->token,
                'provider_name' => $request->type,
                'avatar_url' => $request->avatar_url
            ]);

            $token = Auth::login($user);
            return response()->json([
                'user' => $user,
                'token' => $token,
            ]);
        }
    }

    public function sessions(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);

    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:16',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'provider_name' => 'email'
        ]);

        $token = Auth::login($user);
        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'user' => Auth::user(),
            'token' => Auth::refresh(),
        ]);
    }

}
