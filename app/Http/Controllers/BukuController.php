<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BukuModel as Buku;
use Auth;

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
                'user' => Auth::user(),
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
