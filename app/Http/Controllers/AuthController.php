<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMail;
use Illuminate\Http\Request;
use App\Jobs\SendEmail;
use App\User;
use JWTAuth;
use DB;

class AuthController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->only('username', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'Username/Password salah!', 'code' => 400], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['message' => 'Kesalahan server! Tidak dapat membuat token', 'code' => 500], 500);
        }

        return response()->json([
            'message' => 'Berhasil login!',
            'code' => 200,
            'token' => $token
        ], 200);
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(),[
                'username' => 'required|max:255|unique:users',
                'email' => 'required|unique:users',
                'password' => 'required|min:8',
                'role' => 'required',
            ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
                'code' => '400'
            ], 400);
        } else {
            $user = User::create([
                'username' => $request->get('username'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
                'role' => $request->get('role')
            ]);
    
            $token = JWTAuth::fromUser($user);
            
            return response()->json([
                'message' => 'Berhasil membuat akun',
                'code' => '200'
            ], 200);
        }
    }

    public function getAuthenticatedUser()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['message' => 'Token Expired', 'code' => $e->getStatusCode()], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['message' => 'Token Invalid', 'code' => $e->getStatusCode()], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['message' => 'Token Absent', 'code' => $e->getStatusCode()], $e->getStatusCode());
        }

        return response()->json([
            'message' => 'Berhasil mengambil data!',
            'data' => $user,
            'code' => 200
        ], 200);
    }

    public function verification($user_id, $code) {
        $code = base64_decode($code);
        $email = explode('|', $code);
        try {
            DB::beginTransaction();

            User::where('user_id', $user_id)
                ->where('email', $email[1])
                ->update([
                    'email_verified_at' => date('Y-m-d H:i:s')
                ]);
        } catch(\Exception $e) {
            DB::rollback();

            return response()->json([
                'code' => 400,
                'message' => $e->getMessage()
            ], 400);
        }

        DB::commit();

        return response()->json([
            'code' => 200,
            'message' => 'Berhasil verifikasi'
        ], 200);
    }

    public function logout() {
        auth()->logout();

        return response()->json([
            'code' => 200,
            'message' => 'Logout berhasil'
        ], 200);
    }
}
