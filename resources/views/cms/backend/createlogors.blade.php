@extends('cms.layout.main')
@section('contentadmin')
<div class="container mt-4">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Buat Logo RS</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right" style="background-color:#f4f6f9;">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Buat Logo RS</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Input Data RS
                </div>
                <div class="card-body">
                    <form action="/admin/rs" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama_rs">Nama RS</label>
                            <input type="text" class="form-control" id="nama_rs" name="nama_rs" aria-describedby="emailHelp" placeholder="Masukkan Nama RS" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Logo RS (Image)</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                        <!-- id_rs is usually auto-incremented in the database, so no need to include this in the form -->
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    @if ($message = Session::get('success'))

        Swal.fire({
            title: "Berhasil!",
            text: "{{ $message }}",
            icon: "success",
            button: "OK",
        });

    @endif
</script>
<script>
    @if ($message = Session::get('error'))

        Swal.fire({
            title: "Gagal!",
            text: "{{ $message }}",
            icon: "error",
            button: "OK",
        });

    @endif
</script>
@endsection
