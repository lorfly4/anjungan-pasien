@extends('cms.layout.main')
@section('contentadmin')
    <div class="container mt-4">
        {{-- Header --}}
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Loket</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="background-color:#f4f6f9;">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Edit Loket</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Loket</h3>
                    </div>
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('loket.proseseditloket', $lokets->id_lokets)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="nama_loket">Nama Loket</label>
                                        <input type="text" class="form-control" name="nama_loket" id="nama_loket"
                                            value="{{ old('nama_loket', $lokets->nama_lokets) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_berobat">Jenis Berobat</label>
                                        <input type="text" class="form-control" name="jenis_berobat" id="jenis_berobat"
                                            value="{{ old('jenis_berobat', $lokets->jenis_berobat) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <input type="text" class="form-control" name="keterangan" id="keterangan"
                                            value="{{ old('keterangan', $lokets->keterangan) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="kategori">Kategori</label>
                                        <select name="kategori" id="kategori" class="form-control">
                                            <option value="" disabled>Pilih Kategori</option>
                                            @foreach ($kategoris as $kategori)
                                                <option value="{{ $kategori->id_kategoris }}"
                                                    {{ $kategori->id_kategoris == $lokets->id_kategoris ? 'selected' : '' }}>
                                                    {{ $kategori->kategoris }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="dokter">Dokter</label>
                                        <select name="dokter" id="dokter" class="form-control">
                                            <option value="" disabled>Pilih Dokter</option>
                                            @foreach ($dokters as $dokter)
                                                <option value="{{ $dokter->id_dokter }}"
                                                    {{ $dokter->id_dokter == $lokets->id_dokter ? 'selected' : '' }}>
                                                    {{ $dokter->nama_dokter }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="poli">Poli</label>
                                        <select name="poli" id="poli" class="form-control">
                                            <option value="" disabled>Pilih Poli</option>
                                            @foreach ($polis as $poli)
                                                <option value="{{ $poli->id_poli }}"
                                                    {{ $poli->id_poli == $lokets->id_poli ? 'selected' : '' }}>
                                                    {{ $poli->nama_poli }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="active" {{ $lokets->status == 'active' ? 'selected' : '' }}>Aktif</option>
                                            <option value="inactive" {{ $lokets->status == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary" onclick="Swal.fire({ title: 'Saved!', text: 'Your data has been saved.', icon: 'success', confirmButtonText: 'OK' });">Simpan</button>
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