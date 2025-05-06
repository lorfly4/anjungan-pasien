<!DOCTYPE html>
<html>
<head>
    <title>Rekam Medis</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        .box { width: 70%; margin: auto; border: 1px solid #ccc; padding: 20px; box-shadow: 2px 2px 10px rgba(0,0,0,0.1); }
        h1 { background: royalblue; color: white; padding: 10px 0; }
        .data { display: flex; justify-content: space-around; text-align: left; margin-top: 20px; }
        .next-btn { background: green; color: white; padding: 10px 20px; text-decoration: none; font-weight: bold; border-radius: 4px; display: inline-block; margin-top: 20px; }
    </style>
</head>
<body>
    <h2>TAMPILAN DATA PASIEN SESUAI SIM RS</h2>
    <div class="box">
        <h1>REKAM MEDIS</h1>
        <div class="data">
            <div>
                <strong>Data Pasien</strong><br>
                Nama: {{ $data['nama_lengkap'] }}<br>
                No RM: {{ $data['no_rm'] }}<br>
                NIK: {{ $data['nik'] }}<br>
                Jenis Kelamin: {{ $data['jenis_kelamin'] }}<br>
                Tempat Lahir: {{ $data['tempat_lahir'] }}<br>
                Tanggal Lahir: {{ $data['tanggal_lahir'] }}<br>
                Alamat: {{ $data['alamat'] }}<br>
                No HP: {{ $data['no_hp'] }}<br>
                Email: {{ $data['email'] }}<br>
                Tanggal Daftar: {{ $data['tanggal_daftar'] }}<br>
            </div>
            <div>
                <strong>DATA MEDIS YANG PERLU DIPERHATIKAN</strong><br>
                <ol>
                    <li>Riwayat Penyakit</li>
                    <li>Alergi Obat</li>
                    <li>Riwayat Operasi</li>
                    <li>Golongan Darah</li>
                    <li>Status Imunisasi</li>
                    <li>Kondisi Terkini</li>
                    <li>Tinggi & Berat Badan</li>
                </ol>
            </div>
        </div>
        <a href="/umum/registrasi" class="next-btn">NEXT</a>
    </div>
</body>
</html>
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session("success") }}',
    });
</script>
@endif
@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: '{{ session("error") }}',
    });
</script>
@endif
