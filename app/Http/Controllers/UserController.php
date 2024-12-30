<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function signUp(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'phone' => 'required|string|max:15',
                'gender' => 'required|string|in:male,female,other',
                'date_of_birth' => 'required|date',
                'password' => 'required|string|min:6',
            ]);

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth,
                'password' => Hash::make($request->password),
            ]);

            $token = $user->createToken('MyAppToken')->plainTextToken;


            return response()->json([
                'success' => true,
                'msg' => "user created Successfuly",
                'token' => $token,

            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'msg' => 'Registration failed:' . $th->getMessage(),
            ]);
        }
    }

    function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|string|email|max:255',
                'password' => 'required|max:255'
            ]);

            $user = User::where('email', $request->email)->first();

            

            if ($user && Hash::check($request->password , $user->password )) {


                // Output the user as JSON
                return response()->json([
                    'success' => true,
                    'user' => $user,
                ]);     
            } else {
                return response()->json([
                    'success' => false,
                    'msg' => 'User not found',
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'msg' => ' failed:' . $th->getMessage(),
            ]);
        }
    }
}
