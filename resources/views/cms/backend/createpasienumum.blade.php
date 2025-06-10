@extends('cms.layout.main')
@section('contentadmin')

<div class="container mt-4">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Buat Pasien Umum</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right" style="background-color:#f4f6f9;">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Buat Pasien Umum</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Masukan Data Pasien Umum
                </div>
                <div class="card-body">
                    <form action="{{ route('pasienumum.prosescreatepasienumum')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="poli">Nomor Rekam Medis</label>
                            <input type="text" class="form-control" id="no_rm" name="no_rm" aria-describedby="emailHelp" placeholder="Masukkan Nomor Medis" required>
                        </div>
                        <div class="form-group">
                            <label for="status-poli">Nama Lengkap Pasien</label>
                            <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" aria-describedby="emailHelp" placeholder="Masukkan Nama Lengkap Pasien" required>
                        </div>
                        <div class="form-group">
                            <label for="status-poli">NIK Pasien</label>
                            <input type="text" class="form-control" id="nik_pasien" name="nik_pasien" aria-describedby="emailHelp" placeholder="Masukkan Nama NIK Pasien (14 digit)" minlength="14" maxlength="14">
                        </div>
                        <div class="form-group">
                            <label for="jk_pasien">Jenis Kelamin Pasien</label>
                            <select class="form-control" id="jk_pasien" name="jk_pasien" required>
                                <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status-poli">Tempat Tanggal Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" aria-describedby="emailHelp" placeholder="Masukkan Tempat Lahir Pasien" required>
                        </div>
                        <div class="form-group">
                            <label for="status-poli">Tanggal Lahir Pasien</label>
                            <input type="date" class="form-control" id="tahun_lahir" name="tahun_lahir" aria-describedby="emailHelp" placeholder="Masukkan Tahun Lahir Pasien" required>
                        </div>
                        <div class="form-group">
                            <label for="status-poli">Alamat Pasien</label>
                            <textarea class="form-control" id="alamat_pasien" name="alamat_pasien" aria-describedby="emailHelp" placeholder="Masukkan Alamat Pasien" required rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="status-poli">Nomor HP Pasien</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" aria-describedby="emailHelp" placeholder="Masukkan Nomor HP Pasien" required>
                        </div>
                        <div class="form-group">
                            <label for="status-poli">Email Pasien</label>
                            <input type="text" class="form-control" id="email_pasien" name="email_pasien" aria-describedby="emailHelp" placeholder="Masukkan Email Pasien" required>
                        </div>
                        <div class="form-group">
                            <label for="status-poli">Status Pasien</label>
                            <input type="text" class="form-control" id="status_pasien" name="status_pasien" aria-describedby="emailHelp" placeholder="Masukkan Status Pasien" required>
                        </div>
                        
                    </form>
            </div>
    </div>
</div>


@endsection