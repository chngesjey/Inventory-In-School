<?php

namespace App\Http\Controllers;

use App\Models\Tempat;
use Illuminate\Http\Request;
use Validator;

class TempatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tempat = Tempat::all();
        return view('tempat.index', compact('tempat'));
    }
    
    public function data() // Menambahkan DataTable
    {
        $tempat = Tempat::orderBy('id', 'desc')->get();

        return datatables()
        ->of($tempat)
        ->addIndexColumn()
        ->addColumn('aksi', function($tempat){
            return '
            
            <div class="btn-group">
                <button onclick="editData(`' .route('tempat.update', $tempat->id). '`)" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                <button onclick="deleteData(`' .route('tempat.destroy', $tempat->id). '`)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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

        $tempat = Tempat::create([
            'nama' => $request->nama 
        ]);

        return response()->json([
            'success'=>true,
            'message' => 'Data Berhasil Tesimpan',
            'data' => $tempat
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tempat  $tempat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tempat = Tempat::find($id);
        return response()->json($tempat);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tempat  $tempat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tempat = Tempat::find($id);
        return view('tempat.index', compact ('tempat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tempat  $tempat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $tempat = Tempat::find($id);
        $tempat->nama = $request->nama;
        $tempat->update();

        return response()->json('Data Berhasil Disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tempat  $tempat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tempat = Tempat::find($id);
        $tempat->delete();

        return redirect('tempat');
    }
}
