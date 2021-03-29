<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NilaiModel as Nilai;
use App\Models\KomikModel as Komik;
use Datatables;
use Yajra\Datatables\QueryDataTable;
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
        // $data = Komik::all();
        // dd($data[0]->ujian_nilai);
        if ($request->ajax()) {
            $datatables = new Datatables;
            $data = DB::table('nilai')
                    ->select('profil_user.nama', 'komik.judul', 'nilai.nilai_angka')
                    ->join('users', 'users.user_id', '=', 'nilai.user_id')
                    ->join('ujian', 'ujian.ujian_id', '=', 'nilai.ujian_id')
                    ->join('komik', 'komik.komik_id', '=', 'ujian.komik_id')
                    ->join('profil_user', 'profil_user.user_id', '=', 'users.user_id');

            return $datatables->queryBuilder($data)
                ->toJson();
        }

        return view('admin.nilai');
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
