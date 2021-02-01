<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BukuModel as Buku;
use Auth;
use DB;

class BukuController extends Controller
{
    public function index() {
        try {
            $data = Buku::whereNull('deleted_at')->get();
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => 'Internal Server Error. ErrMsg = '.$e->getMessage()
            ]);
        }

        if(!$data->isEmpty()) {
            return response()->json([
                'code' => 200,
                'message' => 'Data berhasil ditemukan!',
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
        $buku = new Buku;

        DB::beginTransaction();
        try {
            $buku->judul = $request->get('judul');
            $buku->tingkat = $request->get('tingkat');
            $insert = $buku->save();
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
            ],200);
        } else {
            DB::rollback();
            return response()->json([
                'code' => 400,
                'message' => 'Gagal menambahkan data'
            ], 400);
        }
    }
}
