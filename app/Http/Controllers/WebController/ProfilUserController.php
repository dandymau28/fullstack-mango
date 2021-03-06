<?php

namespace App\Http\Controllers\WebController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfilUserModel as Profil;
use App\User;
use DB;

class ProfilUserController extends Controller
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
    public function show()
    {
        $id = auth()->user()->user_id;

        $profil = Profil::whereNull('deleted_at')->where('user_id', $id)->first();

        return view('profil')->with([
            'profil' => $profil
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
    public function update(Request $request)
    {
        DB::beginTransaction();

        try {
            $update_profil = Profil::where('user_id', auth()->user()->user_id)
                        ->update([
                            'nama' => $request->nama,
                            'nomor_hp' => $request->nomor_hp
                        ]);

            $update_email = User::where('user_id', auth()->user()->user_id)
                            ->update([
                                'email' => $request->email
                            ]);
        } catch(Exception $e) {
            DB::rollback();
            return back()->with([
                'error' => 'Gagal update profil. ErrMsg: ' . $e->getMessage()
            ]);
        }
        DB::commit();

        return back()->with([
            'success' => 'Berhasil update profil'
        ]);
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
