<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SoalModel as Soal;
use App\Models\PilihanJawabanModel as PilihanJawaban;
use DB;

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

    public function store(Request $request) {
        
        // return response()->json($request);
        // $i = 0;
        DB::beginTransaction();
        try {
            foreach($request->get('soal') as $soal_input) {
                $soal = new Soal;
                $soal->pertanyaan = $soal_input['soal'];
                $soal->jawaban_benar = $soal_input['jawaban_benar'];
                $soal->ujian_id = $soal_input['ujian_id'];
                $insert_soal = $soal->save();
                foreach($soal_input['jawaban'] as $jawaban) {
                    $pilihan_jawaban = new PilihanJawaban;
                    $pilihan_jawaban->soal_id = $soal->soal_id;
                    $pilihan_jawaban->jawaban = $jawaban;
                    $insert_jawaban = $pilihan_jawaban->save();
                }
                // $i++;
            }
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'code' => 500,
                'message' => 'Internal server error. ErrMsg = ' . $e->getMessage()
            ], 500);
        }

        if ($insert_soal) {
            DB::commit();
            return response()->json([
                'code' => 200,
                'message' => 'Berhasil menambahkan data'
            ], 200);
        } else {
            DB::rollback();
            return response()->json([
                'code' => 400,
                'message' => 'Gagal menambahkan data'
            ], 400);
        }
    }
}
