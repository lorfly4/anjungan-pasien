@extends('cms.layout.main')
@section('contentadmin')

<div class="container mt-4">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Edit Kategori</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right" style="background-color:#f4f6f9;">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Edit Kategori</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Input Data Kategori
                </div>
                <div class="card-body">
                    <input class="" type="hidden" id="id_kategoris" name="id_kategoris" value="#">
                    <form action="{{ route('kategori.proseseditkategori', $kategori->id_kategoris)}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="kategori">Nama Kategori</label>
                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" aria-describedby="emailHelp" placeholder="Masukkan Nama Kategori" value="{{ $kategori->kategoris }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary" onclick="if(document.getElementById('nama_kategori').value != '') { Swal.fire('Saved!', 'Your data has been saved.', 'success'); } else { Swal.fire('Error!', 'Please enter a valid Kategori name.', 'error'); return false; }">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
