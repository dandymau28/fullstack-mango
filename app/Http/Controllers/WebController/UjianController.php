<?php

namespace App\Http\Controllers\WebController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UjianModel as Ujian;
use App\Models\SoalModel as Soal;
use App\Models\PilihanJawabanModel as Jawaban;

class UjianController extends Controller
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
    public function store(Request $request, $id)
    {
        $nilai = 0;
        $ujian = Ujian::whereNull('deleted_at')->where('komik_id', $id)->first();

        foreach($ujian->soal as $soal) {
            if ($soal->jawaban_benar == $request->input($soal->soal_id)) {
                $nilai++;
            }
        }

        dd('nilai Anda = '. $nilai);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ujian = Ujian::whereNull('deleted_at')->where('komik_id', $id)->first();

        $jumlahSoal = count($ujian->soal);

        return view('latihan')->with([
            'ujian' => $ujian,
            'jumlah_soal' => $jumlahSoal
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
