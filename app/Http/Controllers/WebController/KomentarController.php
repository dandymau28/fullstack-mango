<?php

namespace App\Http\Controllers\WebController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KomentarModel as Komentar;
use DB;

class KomentarController extends Controller
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
        $komentar = new Komentar;

        $backUrl = app('url')->previous() . '#komentar';

        DB::beginTransaction();
        try {
            $komentar->user_id = auth()->user()->user_id;
            $komentar->komik_id = $request->input('komik_id');
            $komentar->isi_komentar = $request->input('komentar');
            $komentar->save();
        } catch (Exception $e) {
            DB::rollback();
            return back()->with([
                'error' => 'Gagal memasukkan komentar. ErrMsg: '.$e->getMessage()
            ]);
        }
        DB::commit();

        return redirect()->to($backUrl)->with([
            'success' => 'Berhasil komentar!'
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
