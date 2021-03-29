<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UjianModel as Ujian;
use App\Models\KomikModel as Komik;
use App\Models\SoalModel as Soal;
use App\Models\PilihanJawabanModel as Jawaban;
use Datatables;
use DB;

class UjianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Ujian::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('komik', function($data) {
                    return $data->komik->judul;
                })
                ->addColumn('action', function($data){ 
                    $btn = '<a href="ujian/' . $data->ujian_id . '" class="btn btn-warning btn-sm">Edit</a>' . "<button onclick='deleteUrl(" . $data->ujian_id  . ")' class='btn btn-danger btn-sm mx-2'>Delete</button>";

                    return $btn;
                })
                ->make(true);
        }
        return view('admin.ujian');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $komik = Komik::all();

        return view('admin.tambah-ujian')->with([
            'daftar_komik' => $komik
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $insertUjian = Ujian::create([
                'komik_id' => $request->input('komik'),
                'waktu_ujian' => $request->input('tanggal_ujian') . ' ' .$request->input('jam_ujian'),
                'durasi_ujian' => $request->input('durasi_ujian')
            ]);

            for($i = 0; $i < count($request->input('pertanyaan')); $i++) {
                $stateSoal = 'soal_' . ($i + 1);

                // dd($request->input('jawaban_' . $request->input('jawaban_benar')[$stateSoal])[$i]);

                $insertSoal = Soal::create([
                    'ujian_id' => $insertUjian->ujian_id,
                    'pertanyaan' => $request->input('pertanyaan')[$i],
                    'jawaban_benar' => $request->input('jawaban_' . $request->input('jawaban_benar')[$stateSoal])[$i]
                ]);

                for($j = 0; $j < 4; $j++) {
                    $jawaban = Jawaban::create([
                        'soal_id' => $insertSoal->soal_id,
                        'jawaban' => $request->input('jawaban_'.($j + 1))[$i]
                    ]);
                }
            }
        } catch(Exception $e) {
            DB::rollback();
            return back()->with([
                'error' => 'Gagal input ujian. ErrMsg: ' . $e->getMessage()
            ]);
        }

        DB::commit();
        return redirect(route('admin-ujian'))->with([
            'success' => 'Berhasil input ujian.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ujian = Ujian::find($id);
        $soal = $ujian->soal;
        $komik = Komik::all();
        $unixTime = strtotime($ujian->waktu_ujian);

        return view('admin.edit-ujian')->with([
            'ujian' => $ujian,
            'soal' => $soal,
            'komik' => $komik
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
        DB::beginTransaction();

        try {
            $soal = Soal::where('ujian_id', $id)->get();
            foreach($soal as $sl) {
                $hapus_jawaban = Jawaban::where('soal_id', $soal)->delete();
            }
            $hapus_soal = Soal::where('ujian_id', $id)->delete();
            $hapus_ujian = Ujian::where('ujian_id', $id)->delete();
        } catch (Exception $e) {
            DB::rollback();
            return back()->with([
                'error' => 'Gagal hapus ujian. ErrMsg: ' . $e->getMessage()
            ]);
        }

        DB::commit();

        return back()->with([
            'success' => 'Berhasil hapus ujian.'
        ]);
    }
}
