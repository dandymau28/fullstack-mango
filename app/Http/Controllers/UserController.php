<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use DB;

class UserController extends Controller
{
    public function showByIdUser ($user_id) {
        try {
            $data = DB::table('profil_user')
                    ->where('user_id', $user_id)
                    ->whereNull('deleted_at')
                    ->get();
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => 'Internal Server Error. ErrMsg = '.$e->getMessage()
            ]);
        }

        if (!$data->isEmpty()) {
            return response()->json([
                'code' => 200,
                'message' => 'Data ditemukan',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    public function updateByIdUser($user_id, Request $request) {
        //Mengubah data profil
    }

    public function updatePasswordByIdUser($user_id, Request $request) {
        //Mengubah password
    }
}
