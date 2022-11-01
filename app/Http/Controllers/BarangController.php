<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Tempat;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Validator;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bulan = date('m');
        $tahun = date('Y');
        $maxid = Barang::max('id')+1;

        $barang = Barang::all();
        $tempat = Tempat::all();
        $kategori = Kategori::all();
        $kode = 'INV'. '/'. $maxid. '/'. $bulan. '/'. $tahun;
        return view('barang.index', compact('barang', 'tempat', 'kategori', 'kode'));
    }

    public function data()
    {
     

        $barang = barang::orderBy('id', 'desc')->get();

        return datatables()
            ->of($barang)
            ->addIndexColumn()
            ->addColumn('kategori_id', function($barang){
                return !empty($barang->kategori->nama) ? $barang->kategori->nama : '-';
            })
            ->addColumn('tempat_id', function($barang){
                return !empty($barang->tempat->nama) ? $barang->tempat->nama : '-';
            })
            ->addColumn('aksi', function($barang){
                return '

                <div class="btn-group">
                    <button onclick="editData(`' .route('barang.update', $barang->id). '`)" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                    <button onclick="deleteData(`' .route('barang.destroy', $barang->id). '`)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                    <button onclick="deleteData(`' .route('barang.destroy', $barang->id). '`)" class="btn btn-success btn-sm"><i class="fa fa-print"></i></button>
                </div>

                ';
            })
            ->rawColumns(['aksi', 'kategori_id', 'tempat_id'])
            ->make(true);
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
            'kode' => 'required',
            'nama' => 'required',
            'kategori_id' => 'required',
            'tempat_id' => 'required',
            'stok' => 'required',
            'keterangan' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $barang = Barang::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
            'tempat_id' => $request->tempat_id,
            'stok' => $request->stok,
            'keterangan' => $request->keterangan
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan',
            'data' => $barang
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang = Barang::find($id);
        return response()->json($barang);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Barang::find($id);
        return view('barang.form', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);
        $barang->nama = $request->nama;
        $barang->update();

        return response()->json('Data Berhasil Disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::find($id);
        $barang->delete();

        return redirect('barang');
    }
}