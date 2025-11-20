<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\UserModel;
use App\Models\UserDetail;

class AuthController extends Controller
{
    public function Register(Request $req)
    {
        $rules = [
            'role_id' => 'required|integer',
            'email' => 'required|string',
            'password' => 'required|string|min:6',
            'user_name' => 'required|string',
            'address' => 'required|string',
            'user_phone' => 'required|string',
        ];
        $validator = Validator::make($req->all, $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        $user = UserModel::create(
            [
                'role_id' => $req->role_id,
                'email' => $req->email,
                'password' => Hash::make($req->password),
            ]
        );
        $token = $user->createToken('Personal Access Token')->plainTextToken;
        $user_detail = UserDetail::create([
            'user_id' => $user->user_id,
            'user_name' => $req->user_name,
            'address' => $req->address,
            'user_phone' => $req->user_phone,
            'user_status' => 'Available',
        ]);
        $response = ['user' => $user, 'user_detail' => $user_detail, 'token' => $token];
        return response()->json($response, 201);
    }

    public function Login(Request $req)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];

        try {
            $req->validate($rules);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors()
            ], 422);
        }

        $user = UserModel::where('email', $req->email)->first();
        if (!$user || !Hash::check($req->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid Login Data'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        $user->load('detail');

        return response()->json([
            'message' => 'Login Success',
            'token' => $token,
            'user' => $user,
        ], 201);
    }
}
