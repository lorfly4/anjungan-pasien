@extends('cms.layout.main')
@section('contentadmin')
    <div class="container mt-4">
        {{-- Header --}}
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Create Loket</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="background-color:#f4f6f9;">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Create Loket</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Loket</h3>
                    </div>
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('loket.prosescreateloket')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Nama Loket</label>
                                        <input type="text" class="form-control" name="nama_loket" id="nama_loket"
                                            aria-describedby="nama_loket">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Jenis Berobat</label>
                                        <input type="text" class="form-control" name="jenis_berobat" id="jenis_berobat"
                                            aria-describedby="jenis_berobat">
                                    </div>
                                    <div class="form-group">
                                        <label for="poli_id">Keterangan</label>
                                        <input type="text" class="form-control" name="keterangan" id="keterangan"
                                            aria-describedby="keterangan">
                                    </div>
                                    <div class="form-group">
                                        <label for="kategori">Kategori</label>
                                        <select name="kategori" id="kategori" class="form-control">
                                            <option value="" selected disabled>Pilih Kategori</option>
                                            @foreach ($kategoris as $kategori)
                                                <option value="{{ $kategori->id_kategoris }}">{{ $kategori->kategoris }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="dokter">Dokter</label>
                                        <select name="dokter" id="dokter" class="form-control">
                                            <option value="" selected disabled>Pilih Dokter</option>
                                            @foreach ($dokters as $dokter)
                                                <option value="{{ $dokter->id_dokter }}">{{ $dokter->nama_dokter }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="poli">Poli</label>
                                        <select name="poli" id="poli" class="form-control">
                                            <option value="" selected disabled>Pilih Poli</option>
                                            @foreach ( $polis as $poli)
                                                <option value="{{ $poli->id_poli}}" id="poli" class="form-control">
                                                    {{ $poli->nama_poli }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="" selected disabled>Pilih Status</option>
                                            <option value="active">Aktif</option>
                                            <option value="inactive">Tidak Aktif</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary"
                                        onclick="showSweetAlert()">Submit</button>
                                    <script>
                                        function showSweetAlert() {
                                            Swal.fire({
                                                title: 'Success!',
                                                text: 'Your changes have been saved.',
                                                icon: 'success',
                                                confirmButtonText: 'OK'
                                            });
                                        }
                                    </script>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    </div>
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    <!-- /.content -->
@endsection
