@extends('cms.layout.main')
@section('contentadmin')
    <div class="container mt-4">
        {{-- Header --}}
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Jadwal Dokter</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="background-color:#f4f6f9;">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Edit Jadwal Dokter</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Jadwal Dokter</h3>
                    </div>
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('dokter.proseseditjadwaldokter', $jadwaldokter->id_jadwal_dokter)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="hari">Hari</label>
                                        <input type="text" class="form-control" id="hari" name="hari" required
                                            value="{{ old('hari', $jadwaldokter->hari) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="jam_mulai">Jam Mulai</label>
                                        <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" required
                                            value="{{ old('jam_mulai', $jadwaldokter->jam_mulai) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="jam_selesai">Jam Selesai</label>
                                        <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" required
                                            value="{{ old('jam_selesai', $jadwaldokter->jam_selesai) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="id_dokter">Dokter</label>
                                        <select name="id_dokter" id="id_dokter" class="form-control" required>
                                            <option value="" disabled>Pilih Dokter</option>
                                            @foreach ($dokters as $dokter)
                                                <option value="{{ $dokter->id_dokter }}"
                                                    {{ $dokter->id_dokter == $jadwaldokter->id_dokter ? 'selected' : '' }}>
                                                    {{ $dokter->nama_dokter }}
                                                </option>
                                            @endforeach
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
