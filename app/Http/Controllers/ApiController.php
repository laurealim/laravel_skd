<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            $error_messages = $validator->errors()->first();
            $response= [
                'status' => 'false',
                'message' => $error_messages,
            ];
            return response()->json($response, 401);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status'=> 'false',
                'message' => 'Invalid credentials'
            ], 401);
        }else{
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'status'=> 'true',
                'message' => 'Login successful',
                'token' => $token
            ]);
        }
        // return response()->json(['message' => 'Login successful']);
    }
    public function register(Request $request)
    {
        // Handle registration logic here
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        if ($validator->fails()) {
            $error_messages = $validator->errors()->first();
            $response= [
                'status' => 'false',
                'message' => $error_messages,
            ];
            return response()->json($response, 401);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        return response()->json([
            'status'=> 'true',
            'message' => 'Registration successful'
        ]);
    }
    public function logout(Request $request)
    {
        // Handle logout logic here
        request()->user()->currentAccessToken()->delete();
        return response()->json([
            'status'=> 'true',
            'message' => 'Logout successful'
        ],200);
    }

    public function getPeople(Request $request)
    {
        $peopleData = Person::all();
        if ($peopleData->isEmpty()) {
            return response()->json(['message' => 'No people found'], 404);
        }
        return response()->json(['people' => $peopleData], 200);
    }
}
