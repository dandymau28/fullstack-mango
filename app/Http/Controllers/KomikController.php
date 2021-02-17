<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\KomikModel as Komik;
use App\Models\AlamatKomikModel as AlamatKomik;
use DB;

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
            $data = Komik::whereNull('deleted_at')
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

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'buku_id' => 'required',
            'judul' => 'required',
            'tingkat' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validator->errors()
            ], 400);
        }

        $komik = new Komik;

        DB::beginTransaction();
        try {
            $komik->buku_id = $request->get('buku_id');
            $komik->judul = $request->get('judul');
            $komik->tingkat = $request->get('tingkat');
            $komik->status = $request->get('status') == '0' ? 'belum_terbit' : 'terbit';
            $insert = $komik->save();
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
