@extends('cms.layout.main')
@section('contentadmin')

<div class="container mt-4">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Edit Pasien Umum</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right" style="background-color:#f4f6f9;">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Edit Pasien Umum</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Edit Data Pasien Umum
                </div>
                <div class="card-body">
                    <form action="{{ route('pasienumum.proseseditpasienumum', $pasienumum->id_pasien) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="no_rm">Nomor Rekam Medis</label>
                            <input type="text" class="form-control" id="no_rm" name="no_rm" value="{{ old('no_rm', $pasienumum->no_rm) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_pasien">Nama Lengkap Pasien</label>
                            <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" value="{{ old('nama_lengkap', $pasienumum->nama_lengkap) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="nik_pasien">NIK Pasien</label>
                            <input type="text" class="form-control" id="nik_pasien" name="nik_pasien" value="{{ old('nik', $pasienumum->nik) }}" minlength="14" maxlength="14">
                        </div>
                        <div class="form-group">
                            <label for="jk_pasien">Jenis Kelamin Pasien</label>
                            <select class="form-control" id="jk_pasien" name="jk_pasien" required>
                                <option value="" disabled>Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki" {{ old('jk_pasien', $pasienumum->jk_pasien) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="Perempuan" {{ old('jk_pasien', $pasienumum->jk_pasien) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $pasienumum->tempat_lahir) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="tahun_lahir">Tanggal Lahir Pasien</label>
                            <input type="date" class="form-control" id="tahun_lahir" name="tahun_lahir" value="{{ old('tanggal_lahir', $pasienumum->tanggal_lahir) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat_pasien">Alamat Pasien</label>
                            <textarea class="form-control" id="alamat_pasien" name="alamat_pasien" required rows="3">{{ old('alamat', $pasienumum->alamat) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="no_hp">Nomor HP Pasien</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp', $pasienumum->no_hp) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email_pasien">Email Pasien</label>
                            <input type="text" class="form-control" id="email_pasien" name="email_pasien" value="{{ old('email', $pasienumum->email) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="status_pasien">Status Pasien</label>
                            <input type="text" class="form-control" id="status_pasien" name="status_pasien" value="{{ old('status_aktif', $pasienumum->status_aktif) }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary" onclick="Swal.fire({ title: 'Data Berhasil Diupdate!', text: 'Data pasien berhasil diupdate.', icon: 'success', confirmButtonText: 'OK' });">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
