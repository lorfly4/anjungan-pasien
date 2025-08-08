@extends('cms.layout.main')
@section('contentadmin')

<div class="container mt-4">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Create Poli</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right" style="background-color:#f4f6f9;">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Create Poli</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Input Data Poli
                </div>
                <div class="card-body">
                    <form action="{{ route('poli.prosescreatepoli') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="poli">Nama Poli</label>
                            <input type="text" class="form-control" id="nama_poli" name="nama_poli" aria-describedby="emailHelp" placeholder="Masukkan Nama Poli" required>
                        </div>
                        <div class="form-group">
                            <label for="status-poli">Status Poli</label>
                            <input type="text" class="form-control" id="status_poli" name="status_poli" aria-describedby="emailHelp" placeholder="Masukkan Status Poli" required>
                        </div>

                        {{-- <div class="form-group">
                            <label for="kode_poli">Kode Poli</label>
                            <input type="text" class="form-control" id="kode_poli" name="kode_poli" aria-describedby="emailHelp" placeholder="Masukkan Kode Poli">
                        </div> --}}
                        <button type="submit" class="btn btn-primary" onclick="if(document.getElementById('nama_poli').value != '') { Swal.fire('Saved!', 'Your data has been saved.', 'success'); } else { Swal.fire('Error!', 'Please enter a valid Poli name.', 'error'); return false; }">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection