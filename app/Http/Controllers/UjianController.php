<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UjianModel as Ujian;
use App\Models\NilaiModel as Nilai;
use DB;

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

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'komik_id' => 'required',
            'waktu_ujian' => 'required',
            'durasi_ujian' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validator->errors()
            ], 400);
        }

        $ujian = new Ujian;

        DB::beginTransaction();
        try {
            $ujian->komik_id = $request->get('komik_id');
            $ujian->waktu_ujian = $request->get('waktu_ujian');
            $ujian->durasi_ujian = $request->get('durasi_ujian');
            $insert = $ujian->save();
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'code' => 500,
                'message' => 'Internal Server Error. ErrMsg = '.$e->getMessage()
            ], 500);
        }

        if ($insert) {
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

    public function storeByIdUjian (Request $request, $ujian_id) {
        $data = Nilai::whereNull('deleted_at')->where('ujian_id', $ujian_id)
                ->where('user_id', auth()->user()->user_id)->get();

        if (!$data->isEmpty()) {
            return response()->json([
                'code' => 400,
                'message' => 'Tidak dapat input nilai yang sudah ada'
            ], 400);
        }

        DB::beginTransaction();

        try {
            $nilai = new Nilai;
            $nilai->user_id = auth()->user()->user_id;
            $nilai->ujian_id = $ujian_id;
            $nilai->nilai_angka = $request->get('nilai');
            $insert = $nilai->save();

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'code' => 500,
                'message' => 'Internal Server Error. ErrMsg = '.$e->getMessage()
            ], 500);
        }

        if ($insert) {
            DB::commit();
            return response()->json([
                'code' => 200,
                'message' => 'Nilai berhasil diinput'
            ], 200);
        } else {
            DB::rollback();
            return response()->json([
                'code' => 400,
                'message' => 'Nilai gagal diinput'
            ], 400);
        }
    }
}
