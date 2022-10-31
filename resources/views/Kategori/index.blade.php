@extends('template.layout')

@section('title')
    Kategori
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Kategori</h1>
        </div>

        <div class="section-body">
            <div class="row">

                {{-- Data Kategori --}}
                <div class="col-12 col-md-7 col-lg-7">
                    <div class="card">
                        {{-- Judul --}}
                        <div class="card-header">
                            <h4>Data Kategori</h4>
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

                {{-- Tambah Kategori --}}
                <div class="col-12 col-md-5 col-lg-5">
                    <div class="card">

                        <div class="card-header">
                            <h4>Tambah Kategori</h4>
                        </div>

                        <div class="card-body" id="formTambah">
                            <form action="{{route('kategori.store')}}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="form-group">

                                    {{-- Add Nama --}}
                                    <label class="" for="nama">Nama Kategori</label>
                                    <input type="text" name="nama" id="nama" value="{{ old('nama')}}" class="form-control @error('nama') is-invalid @enderror">
                                    @error('nama')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    {{-- Tombol simpan dan batal --}}
                                    <div class="footer mt-2">
                                        <button type="submit" class="btn btn-success">Simpan</  button>
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
                url: '{{ route('kategori.data') }}'
            },
            columns: [
                {data: 'DT_RowIndex'},
                {data: 'nama'},
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