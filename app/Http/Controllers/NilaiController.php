<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NilaiModel as Nilai;

class NilaiController extends Controller
{
    public function index () {
        try {
            $data = Nilai::whereNull('deleted_at')
                    ->orderBy('nilai_angka', 'desc')
                    ->orderBy('created_at', 'desc')
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

    public function showByIdUjian ($ujian_id) {
        try {
            $data = Nilai::whereNull('deleted_at')
                    ->where('ujian_id', $ujian_id)
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

    public function showByIdUser($user_id) {
        try {
            $data = Nilai::whereNull('deleted_at')
                    ->where('user_id', $user_id)
                    ->get();
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => 'Internal Server Error. ErrMsg = ' . $e->getMessage()
            ], 500);
        }

        if (!$data->isEmpty()) {
            return response()->json([
                'code' => 200,
                'message' => 'Data ditemukan',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'code' => 400,
                'message' => 'Data tidak ditemukan'
            ], 400);
        }
    }
}
