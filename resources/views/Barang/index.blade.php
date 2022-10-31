@extends('template.layout')
@section('title')
    Barang
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Barang</h1>
        </div>
        <div class="section-body">
            <div class="row">
                {{-- Data Barang --}}
                <div class="col-12 col-md-7 col-lg-7">
                    <div class="card">
                        {{-- Judul --}}
                        <div class="card-header">
                            <h4>Data Barang</h4>
                        </div>
                        {{-- Tabel --}}
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td scope="col" style="width: 5%;">No</td>
                                        <td scope="col">Kode</td>
                                        <td scope="col">Nama</td>
                                        <td scope="col">Kategori</td>
                                        <td scope="col">Tempat</td>
                                        <td scope="col">Stok</td>
                                        <td scope="col">keterangan</td>
                                        <td scope="col" style="width: 15%;">Aksi</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- Tambah Barang --}}
                <div class="col-12 col-md-5 col-lg-5">
                    <div class="card">

                        <div class="card-header">
                            <h4>Tambah Barang</h4>
                        </div>

                        <div class="form-group" id="formTambah">
                            <form action="{{ route('barang.store') }}" method="POST">
                            @csrf
                            @method('POST')

                                <div class="card-body">

                                    {{-- Add Kode --}}
                                    <label class="" for="nama">Kode Barang</label>
                                    <input type="text" class="form-control" value="Kode Barang..." aria-label="Disabled input example" disabled readonly>

                                    {{-- Add Nama --}}
                                    <label class="" for="nama">Nama Barang</label>
                                    <input type="text" autocomplete="off" name="nama" id="nama" value="{{ old('nama')}}" class="form-control @error('nama') is-invalid @enderror">
                                    @error('nama')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    {{-- Add Kategori --}}
                                    <label class="mt-2" for="nama">Kategori</label>
                                    <select type="text" name="kategori_id" id="kategori_id" value="{{ old('kategori_id')}}" class="form-control @error('kategori_id') is-invalid @enderror">
                                        <option selected>Pilih...</option>
                                        @foreach($kategori as $kategori)
                                            <option value="{{$kategori->id}}">{{$kategori->nama}}</option>
                                        @endforeach
                                    @error('kategori_id')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </select>

                                    {{-- Add Tempat --}}
                                    <label class="mt-2" for="nama">Tempat</label>
                                    <select type="text" name="tempat_id" id="tempat_id" class="form-control @error('tempat_id') is-invalid @enderror">
                                        <option selected>Pilih...</option>
                                        @foreach($tempat as $tempat)
                                            <option value="{{$tempat->id}}">{{$tempat->nama}}</option>
                                        @endforeach
                                    @error('tempat_id')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </select>

                                    {{-- Add Stok --}}
                                    <label class="mt-2" for="nama">Stok Barang</label>
                                    <input type="number" name="stok" id="stok" value="{{ old('stok')}}" class="form-control @error('stok') is-invalid @enderror">
                                    @error('stok')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    {{-- Add Keterangan --}}
                                    <label class="mt-2" for="nama">Keterangan</label>
                                    <textarea type="text" name="keterangan" id="keterangan" value="{{ old('keterangan')}}" class="form-control @error('keterangan') is-invalid @enderror"></textarea>
                                    @error('keterangan')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <div class="footer mt-2">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </div>

                                </div>

                            </form>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('script')
<script>
    // Data Tables
    let table;
    $(function() {
        table = $('.table').DataTable({
            proccesing: true,
            autowidth: false,
            ajax: {
                url: '{{ route('barang.data') }}'
            },
            columns: [
                {data: 'DT_RowIndex'},
                {data: 'kode'},
                {data: 'nama'},
                {data: 'kategori_id'},
                {data: 'tempat_id'},
                {data: 'stok'},
                {data: 'keterangan'},
                {data: 'aksi'}
            ]
        });
    })
    $('#formTambah').on('submit', function(e){
            if(! e.preventDefault()){
                $.post($('#formTambah form').attr('action'), $('#formTambah form').serialize())
                .done((response) => {
                    $('#formTambah form')[0].reset();
                    table.ajax.reload();
                    iziToast.success({
                        title: 'Sukses',
                        message: 'Data berhasil disimpan',
                        position: 'topRight'
                    })
                })
                .fail((errors) => {
                    iziToast.error({
                        title: 'Gagal',
                        message: 'Data gagal disimpan',
                        position: 'topRight'
                    })
                    return;
                })
            }
        })
    </script>
@endpush