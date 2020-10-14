<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SoalModel as Soal;

class SoalController extends Controller
{
    public function showByIdUjian($ujian_id) {
        try {
            $data = Soal::whereNull('deleted_at')
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
}
