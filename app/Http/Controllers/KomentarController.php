<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KomikModel as Komik;
use App\Models\KomentarModel as Komentar;
use Auth;

class KomentarController extends Controller
{
    public function showByIdKomik($komik_id) {
        try {
            $data = Komentar::whereNull('deleted_at')
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

    public function storeByIdKomik($komik_id, Request $request) {
        //Menambahkan Komentar
        $komik = new Komik;
        $komentar = new Komentar;

        $data_komik = $komik->where('komik_id', $komik_id)->first();

        if (!$data_komik) {
            return response()->json([
                'code' => 404,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        $komentar->user_id = Auth::user()->user_id;
        $komentar->komik_id = $komik_id;
        $komentar->isi_komentar = $request->get('komentar');
        $insert = $komentar->save();

        if ($insert) {
            return response()->json([
                'code' => 200,
                'message' => 'Berhasil menambahkan komentar!',
                'status' => $insert
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'message' => 'Gagal menambahkan komentar!'
            ]);
        }
    }
}
