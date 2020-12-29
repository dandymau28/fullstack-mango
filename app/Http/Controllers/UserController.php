<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\ProfilUserModel as Profil;
use App\User;
use JWTAuth;
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
        $profil = new Profil;

        $user = $profil->where('user_id', $user_id)->first();

        if (!$user) {
            return response()->json([
                'code' => 404,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        $data = [
            'kelas' => $request->get('kelas'),
            'nama' => $request->get('nama'),
            'nomor_hp' => $request->get('nomor_hp')
        ];

        $update = $profil->where('user_id', $user_id)->update($data);

        if ($update) {
            return response()->json([
                'code' => 200,
                'message' => 'Data berhasil terupdate'
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'message' => 'Data gagal terupdate'
            ]);
        }
    }

    public function updatePasswordByIdUser($user_id, Request $request) {
        //Mengubah password
        $user = new User;

        $data_user = $user->where('user_id', $user_id)->first();

        if(!$user) {
            return response()->json([
                'code' => 404,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        $data = [
            'password' => Hash::make($request->get('password'))
        ];

        $update = $user->where('user_id', $user_id)->update($data);

        if ($update) {
            return response()->json([
                'code' => 200,
                'message' => 'Password berhasil diperbarui'
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'message' => 'Password gagal diperbarui'
            ]);
        }
    }
}
