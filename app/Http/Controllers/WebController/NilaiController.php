<?php

namespace App\Http\Controllers\WebController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NilaiModel as Nilai;
use DB;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->get('komik_id')) {
            $komik = DB::table('komik')->where('komik_id', $request->get('komik_id'))->first();

            $data_nilai = DB::table('nilai')
                        ->join('profil_user', 'profil_user.user_id', '=', 'nilai.user_id')
                        ->join('ujian', 'ujian.ujian_id', '=', 'nilai.ujian_id')
                        ->join('komik', 'komik.komik_id', '=', 'ujian.komik_id')
                        ->whereNull('nilai.deleted_at')
                        ->where('ujian.komik_id', $request->get('komik_id'))
                        ->select(DB::raw('sum(nilai.nilai_angka) as nilai, profil_user.nama, komik.judul'))
                        ->groupBy('nilai.user_id')
                        ->orderBy('nilai', 'desc')
                        ->get();

            return view('leaderboard')->with([
                'data_nilai' => $data_nilai,
                'komik' => $komik
            ]);
        } else {
            $data_nilai = DB::table('nilai')
                        ->join('profil_user', 'profil_user.user_id', '=', 'nilai.user_id')
                        ->join('ujian', 'ujian.ujian_id', '=', 'nilai.ujian_id')
                        ->join('komik', 'komik.komik_id', '=', 'ujian.komik_id')
                        ->whereNull('nilai.deleted_at')
                        ->select(DB::raw('sum(nilai.nilai_angka) as nilai, profil_user.nama, komik.judul'))
                        ->groupBy('nilai.user_id')
                        ->orderBy('nilai', 'desc')
                        ->get();

            return view('leaderboard')->with([
                'data_nilai' => $data_nilai
            ]);
        }

        
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
        //
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
