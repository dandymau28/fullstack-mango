<?php

namespace App\Http\Controllers\WebController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UjianModel as Ujian;
use App\Models\SoalModel as Soal;
use App\Models\PilihanJawabanModel as Jawaban;
use App\Models\NilaiModel as Nilai;
use App\Models\UserUjianStatusModel as Status;
use DB;

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
        $rumus = 0;
        $ujian = Ujian::whereNull('deleted_at')->where('komik_id', $id)->first();

        foreach($ujian->soal as $soal) {
            if ($soal->jawaban_benar == $request->input($soal->soal_id)) {
                $nilai++;
            }
        }

        $rumus = 100 / count($ujian->soal);

        $nilai = $nilai * $rumus;

        DB::beginTransaction();
        try {
            $input_nilai = new Nilai;
    
            $input_nilai->user_id = auth()->user()->user_id;
            $input_nilai->ujian_id = $ujian->ujian_id;
            $input_nilai->nilai_angka = $nilai;
            $input_nilai->save();

            $status = new Status;
            $status->user_id = auth()->user()->user_id;
            $status->ujian_id = $ujian->ujian_id;
            $status->status = 'sudah_ujian';
            $status->save();
        } catch(Exception $e) {
            DB::rollback();
            return back()->with([
                'error' => 'Gagal menambahkan nilai. ErrMsg = ' . $e->getMessage()
            ]);
        }

        DB::commit();
        return redirect('/leaderboard?komik_id='. $id);
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
        $status = Status::whereNull('deleted_at')
                ->where('ujian_id', $ujian->ujian_id)
                ->where('user_id', auth()->user()->user_id)
                ->get();

        if(!$status->isEmpty()) {
            return back()->with([
                'error' => 'Anda sudah menyelesaikan ujian ini!'
            ]);
        }

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
