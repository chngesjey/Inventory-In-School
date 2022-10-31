<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Validator;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all();
        return view('kategori.index', compact('kategori'));
    }

    public function data() // Menambahkan DataTable
    {
        $kategori = Kategori::orderBy('id', 'desc')->get();

        return datatables()
        ->of($kategori)
        ->addIndexColumn()
        ->addColumn('aksi', function($kategori){
            return '
            
            <div class="btn-group">
                <button onclick="editData(`' .route('kategori.update', $kategori->id). '`)" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                <button onclick="deleteData(`' .route('kategori.destroy', $kategori->id). '`)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
            </div>
        ';
    })
    ->rawColumns(['aksi'])
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
        $validator = Validator::make ($request->all(), [
            'nama' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422); 
        }

        $kategori = Kategori::create([
            'nama' => $request->nama 
        ]);

        return response()->json([
            'success'=>true,
            'message' => 'Data Berhasil Tesimpan',
            'data' => $kategori
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        //
    }
}
