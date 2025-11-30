<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\UserModel;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function User(Request $request)
{
    // $request->user() otomatis ambil user dari token
    return response()->json($request->user());
}
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
        try {
            $req->validate($rules);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors()
            ], 422);
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

    public function me(Request $request)
    {
        $user = $request->user();
        $user->load('detail');

        return response()->json([
            'success' => true,
            'data' => [
                'user_id'    => $user->user_id,
                'email'      => $user->email,
                'role_id'    => $user->role_id,
                'nama'       => $user->detail->user_name ?? '',
                'alamat'     => $user->detail->address ?? '',
                'telepon'    => $user->detail->user_phone ?? '',
            ]
        ]);
    }

    public function updateProfile(Request $req)
    {
        $user = $req->user();
        $detail = $user->detail;

        $rules = [
            'user_name' => 'required|string',
            'address' => 'required|string',
            'user_phone' => 'required|string',
        ];

        $validator = Validator::make($req->all(), $rules);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        $detail->update([
            'user_name' => $req->user_name,
            'address' => $req->address,
            'user_phone' => $req->user_phone,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui',
            'data' => [
                'nama' => $detail->user_name,
                'alamat' => $detail->address,
                'telepon' => $detail->user_phone,
            ]
        ]);
    }
}