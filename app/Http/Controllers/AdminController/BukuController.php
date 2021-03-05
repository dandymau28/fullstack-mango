<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BukuModel as Buku;
use Yajra\Datatables\Datatables;
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
                    $btn = '<a href="#" class="btn btn-primary btn-sm">View</a>';

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
