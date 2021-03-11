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
                        $btn = '<a href="buku/' . $data->buku_id . '" class="btn btn-warning btn-sm">Edit</a>' . "<button onclick='deleteUrl(" . $data->buku_id  . ")' class='btn btn-danger btn-sm mx-2'>Delete</button>";
    
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
