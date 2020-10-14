<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PilihanJawabanModel as Jawaban;

class PilihanJawabanController extends Controller
{
    public function showByIdSoal($soal_id) {
        try {
            $data = Jawaban::whereNull('deleted_at')
            ->where('soal_id', $soal_id)
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
