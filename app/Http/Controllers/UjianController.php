<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UjianModel as Ujian;

class UjianController extends Controller
{
    public function showByIdKomik($komik_id) {
        try {
            $data = Ujian::whereNull('deleted_at')
            ->where('komik_id', $komik_id)
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
}
