<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KomikModel as Komik;
use App\Models\AlamatKomikModel as AlamatKomik;

class KomikController extends Controller
{
    public function index() {
        try {
            $data = Komik::whereNull('deleted_at')
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

    public function showById($komik_id) {
        try {
            $data = AlamatKomik::whereNull('deleted_at')
            ->where('komik_id', $komik_id)
            ->get();
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => 'Internal Server Error. ErrMsg = '.$e->getMessage()
            ]);
        }

        if(!$data->isEmpty()) {
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

    public function showByBuku($buku_id) {
        try {
            $data = Komik::whereNull('deleted_at')
                        ->where('buku_id', $buku_id)
                        ->get();
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => 'Internal Server Error. ErrMsg = '.$e->getMessage()
            ]);
        }

        if(!$data->isEmpty()) {
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
}
