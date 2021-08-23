<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\BukuModel as Buku;
use App\Models\KomikModel as Komik;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use DB;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = DB::table('buku')->whereNull('deleted_at');
            $data = Buku::oldest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $btn = '<a href="buku/' . $data->buku_id . '" class="btn btn-warning btn-sm">Edit</a>' . "<button onclick='deleteUrl(" . $data->buku_id  . ")' class='btn btn-danger btn-sm mx-2'>Delete</button>";

                    return $btn;
                })
                ->addColumn('gambar_sampul', function($data){
                    $img = "<img src=" . asset($data->sampul) . " width='80px' height='80px'>";

                    return $img;

                })
                ->rawColumns(['action', 'gambar_sampul'])
                ->make(true);
        }

        return view('admin.buku');
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
        $validator = Validator::make($request->all(), [
            'judul' => 'required|max:255',
            'kelas' => 'required',
            'sampul' => 'max:2048|mimes:jpeg,jpg,png'
        ],[
            'required' => 'Kolom :attribute harus diisi',
            'judul.max' => ':attribute maksimal 255 huruf',
            'sampul.max' => ':attribute maksimal 2 MB',
            'mimes' => 'Format :attribute harus jpeg, jpg, atau png'
        ]);

        if ($validator->fails()) {
            return back()->with([
                'errors' => $validator->errors()
            ]);
        }

        if ($request->hasFile('sampul')) {
            $file_name = 'sampul-' . str_replace(' ', '-', $request->input('judul')) . '-' . date('H-i') . '.' . $request->sampul->extension();
            $path = 'storage/' . $file_name;
            $upload = $request->sampul->storeAs('public', $file_name);
        } else {
            $path = 'image/Thumbnail.jpg';
        }

        $insert = Buku::create([
            'judul' => $request->input('judul'),
            'tingkat' => $request->input('kelas'),
            'sampul' => $path
        ]);

        return back()->with([
            'success' => 'Data berhasil ditambah'
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
        $data = Buku::find($id);

        return view('admin.edit-buku')->with([
            'buku' => $data
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
        $validator = Validator::make($request->all(), [
            'judul' => 'required|max:255',
            'kelas' => 'required',
            'sampul' => 'max:2048|mimes:jpeg,jpg,png'
        ],[
            'required' => 'Kolom :attribute harus diisi',
            'judul.max' => ':attribute maksimal 255 huruf',
            'sampul.max' => ':attribute maksimal 2 MB',
            'mimes' => 'Format :attribute harus jpeg, jpg, atau png'
        ]);

        if ($validator->fails()) {
            return back()->with([
                'errors' => $validator->errors()
            ]);
        }

        $data = [
            'judul' => $request->input('judul'),
            'tingkat' => $request->input('kelas')
        ];

        DB::beginTransaction();

        try {
            if ($request->hasFile('sampul')) {
                $file_name = 'sampul-' . str_replace(' ', '-', $request->input('judul')) . '-' . date('H-i') . '.' . $request->sampul->extension();
                $path = 'storage/' . $file_name;
                $upload = $request->sampul->storeAs('public', $file_name);
                $data['sampul'] = $path;
            }

            $insert = Buku::where('buku_id', $id)->update($data);
        } catch (Exception $e) {
            DB::rollback();
            return back()->with([
                'error' => 'Gagal edit data. ErrMsg: ' . $e->getMessage()
            ]);
        }

        DB::commit();
        return redirect(route('admin-buku'));
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
            $deleteBuku = Buku::destroy($id);
            $deleteKomik = Komik::where('buku_id', $id)->delete();
        } catch (Exception $e) {
            DB::rollback();

            return back()->with([
                'error' => 'Gagal hapus data. ErrMsg: ' . $e->getMessage()
            ]);
        }

        DB::commit();
        return back()->with([
            'success' => 'Berhasil hapus data'
        ]);
    }
}
