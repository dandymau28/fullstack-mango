<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KomikModel as Komik;
use App\Models\MateriModel as Materi;
use App\Models\BukuModel as Buku;
use App\Models\AlamatKomikModel as Alamat;
use Datatables;
use DB;

class KomikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Komik::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('judul_buku', function($data) {
                        return $data->buku->judul;
                    })
                    ->editColumn('status', function($data) {
                        if ($data->status == 'terbit') {
                            return '<span class="badge badge-primary">Terbit</span>';
                        } else {
                            return '<span class="badge badge-warning">Belum Terbit</span>';
                        }
                    })
                    ->addColumn('action', function($data){
                        $btn = '<a href="komik/' . $data->komik_id . '" class="btn btn-warning btn-sm">Edit</a>' . "<button onclick='deleteUrl(" . $data->komik_id  . ")' class='btn btn-danger btn-sm mx-2'>Delete</button>";

                        return $btn;
                    })
                    ->addColumn('gambar_sampul', function($data) {
                        return "<img src=" . asset($data->sampul) . " width='80px' height='80px'>";
                    })
                    ->removeColumn('buku_id')
                    ->rawColumns(['action', 'gambar_sampul', 'status'])
                    ->make(true);
        }
        return view('admin.komik');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $daftar_buku = Buku::all();

        return view('admin.tambah-komik')->with([
            'daftar_buku' => $daftar_buku
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
            if ($request->hasFile('sampul')) {
                $file_name = 'sampul-komik-' . str_replace(' ', '-', $request->input('judul')) . '.' . $request->sampul->extension();
                $path = 'storage/' . $file_name;
                $upload = $request->sampul->storeAs('public', $file_name);
            } else {
                $path = 'image/Thumbnail.jpg';
            }

            $insertKomik = Komik::create([
                'buku_id' => $request->input('buku'),
                'judul' => $request->input('judul'),
                'tingkat' => $request->input('tingkat'),
                'sampul' => $path,
                'status' => 'terbit'
            ]);

            $i = 0;
            if ($request->has('komik')) {
                foreach($request->komik as $value) {
                    $file_name = str_replace(' ', '-', $request->input('judul')) . '-' . ($i + 1) . '.' . $value->extension();
                    $path = 'storage/' . $file_name;
                    $upload = $value->storeAs('public', $file_name);

                    $insertAlamat = Alamat::create([
                        'komik_id' => $insertKomik->komik_id,
                        'alamat' => $path
                    ]);

                    $insertMateri = Materi::create([
                        'komik_id' => $insertKomik->komik_id,
                        'alamat_komik_id' => $insertAlamat->alamat_komik_id,
                        'isi' => $request->materi[$i],
                    ]);

                    $i++;
                }
            }
        } catch (Exception $e) {
            DB::rollback();
            return back()->with([
                'error' => 'Gagal menambah komik. ErrMsg = ' . $e->getMessage()
            ]);
        }

        DB::commit();
        return redirect(route('admin-komik'))->with([
            'success' => 'Berhasil menambahkan komik'
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
        $komik = Komik::find($id);
        $alamat = $komik->alamat()->get();
        $daftar_buku = Buku::all();

        return view('admin.edit-komik')->with([
            'komik' => $komik,
            'alamat' => $alamat,
            'count' => count($alamat),
            'daftar_buku' => $daftar_buku
        ]);
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
        $komik_id = $id;
        DB::beginTransaction();

        try {
            $dataKomik = [
                'buku_id' => $request->input('buku'),
                'judul' => $request->input('judul'),
                'tingkat' => $request->input('tingkat'),
            ];

            if ($request->hasFile('sampul')) {
                $file_name = 'sampul-komik-' . str_replace(' ', '-', $request->input('judul')) . '.' . $request->sampul->extension();
                $path = 'storage/' . $file_name;
                $upload = $request->sampul->storeAs('public', $file_name);
                $dataKomik['sampul'] = $path;
            }

            $insertKomik = Komik::where('komik_id', $komik_id)
                        ->update($dataKomik);

            if (isset($request->komik)) {
                foreach($request->komik as $key => $value) {
                    if (isset($request->idAlamat[$key])) {
                        $alamat = Alamat::find($request->idAlamat[$key]);
                    } else {
                        $alamat = null;
                    }

                    if($alamat) {
                        $file_name = explode('/', $alamat->alamat)[1];
                    } else {
                        $file_name = str_replace(' ', '-', $request->input('judul')) . '-' . ($key + 1) . '.' . $value->extension();
                    }

                    $path = 'storage/' . $file_name;
                    $upload = $value->storeAs('public', $file_name);

                    if ($alamat && isset($request->idAlamat[$key])) {
                        $insertAlamat = Alamat::where('alamat_komik_id', $request->idAlamat[$key])
                                        ->update([
                                            'alamat' => $path
                                        ]);
                    } else {
                        $insertAlamat = Alamat::create([
                            'komik_id' => $komik_id,
                            'alamat' => $path
                        ]);

                        $insertMateri = Materi::create([
                            'komik_id' => $komik_id,
                            'alamat_komik_id' => $insertAlamat->alamat_komik_id,
                            'isi' => $request->materi[$key]
                        ]);
                    }
                }
            }

            if (isset($request->materi)) {
                foreach($request->materi as $key => $value) {
                    if ($value && isset($request->idAlamat[$key])) {
                        $materi = Materi::where('alamat_komik_id', $request->idAlamat[$key])->first();
                        if ($materi) {
                            $insertMateri = Materi::where('alamat_komik_id', $request->idAlamat[$key])
                                            ->update([
                                                'isi' => $value,
                                            ]);
                        } else {
                            $insertMateri = Materi::create([
                                'alamat_komik_id' => $request->idAlamat[$key],
                                'isi' => $value,
                                'komik_id' => $komik_id
                            ]);
                        }
                    }
                }
            }
        } catch (Exception $e) {
            DB::rollback();
            return back()->with([
                'error' => 'Gagal update data. ErrMsg: ' . $e->getMessage()
            ]);
        }

        DB::commit();
        return redirect(route('admin-komik'))->with([
            'success' => 'Berhasil update data'
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
        DB::beginTransaction();

        try {
            $hapus_materi = Materi::where('komik_id', $id)->delete();
            $hapus_alamatkomik = Alamat::where('komik_id', $id)->delete();
            $hapus_komik = Komik::where('komik_id', $id)->delete();
        } catch (Exception $e) {
            DB::rollback();
            return back()->with([
                'error' => 'Gagal hapus komik. ErrMsg: ' . $e->getMessage()
            ]);
        }
        DB::commit();

        return back()->with([
            'success' => 'Berhasil hapus komik'
        ]);
    }
}
