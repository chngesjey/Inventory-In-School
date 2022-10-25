@extends('template.layout')

@section('title')
    Tempat
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tempat</h1>
        </div>

        <div class="section-body">
            <div class="row">

                {{-- Data Tempat --}}
                <div class="col-12 col-md-7 col-lg-7">
                    <div class="card">
                        {{-- Judul --}}
                        <div class="card-header">
                            <h4>Data Tempat</h4>
                        </div>

                        {{-- Tabel --}}
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td style="width: 5%">No</td>
                                        <td>Nama</td>
                                        <td style="width: 15%">Aksi</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
                </div>

                {{-- Tambah Barang --}}
                <div class="col-12 col-md-5 col-lg-5">
                    <div class="card">
                        {{-- Judul --}}
                        <div class="card-header">
                            <h4>Tambah Tempat</h4>
                        </div>

                        {{-- Form Tambah --}}
                        <div class="card-body">

                            {{-- Add Nama --}}
                            <label class="" for="nama">Nama Barang</label>
                            <input type="text" autocomplete="off" name="nama" id="nama" value="{{ old('nama')}}" class="form-control @error('nama') is-invalid @enderror">
                            @error('nama')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            {{-- Tombol simpan dan batal --}}
                            <div class="footer mt-2">
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection