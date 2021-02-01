<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KomikModel as Komik;
use App\Models\MateriModel as Materi;
use DB;

class MateriController extends Controller
{
    public function showByIdKomik($komik_id) {
        try {
            $data = Materi::whereNull('deleted_at')
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

    public function store(Request $request) {
        $materi = new Materi;

        DB::beginTransaction();
        try {
            $materi->judul = $request->get('judul');
            $materi->komik_id = $request->get('komik_id');
            $materi->isi = $request->get('isi');
            $insert = $materi->save();
        } catch(Exception $e) {
            DB::rollback();
            return response()->json([
                'code' => 400,
                'message' => 'Gagal menambahkan data. ErrMsg : ' . $e->getMessage()
            ], 400);
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
}
