<?php

namespace App\Http\Controllers\WebController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\KomikModel as Komik;
use App\Models\AlamatKomikModel as AlamatKomik;
use App\Models\MateriModel as Materi;
use DB;

class KomikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataKomik = Komik::whereNull('deleted_at')
                ->where('komik_id', $id)
                ->first();

        $alamatKomik = AlamatKomik::whereNull('deleted_at')
                    ->where('komik_id', $id)
                    ->get();

        $komentar = DB::table('komentar')
                    ->join('users', 'komentar.user_id', '=', 'users.user_id')
                    ->join('profil_user', 'profil_user.user_id', '=', 'users.user_id')
                    ->whereNull('komentar.deleted_at')
                    ->where('komentar.komik_id', $id)->select('profil_user.nama', 'profil_user.foto_profil', 'komentar.isi_komentar', 'komentar.created_at')
                    ->orderBy('komentar.created_at', 'desc')
                    ->get();

        $materis = Materi::whereNull('deleted_at')
                ->where('komik_id', $id)
                ->get();

        return view('komik')->with([
            'alamatKomik' => $alamatKomik,
            'dataKomik' => $dataKomik,
            'komentars' => $komentar,
            'materis' => $materis
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
