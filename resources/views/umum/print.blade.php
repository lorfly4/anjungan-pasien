{{-- filepath: c:\Users\ADDO\Desktop\anjungan_pasien\resources\views\umum\print.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>Cetak Antrian</title>
</head>
<body>
    <h1>Cetak Antrian</h1>
    <p>Nama: {{ $pasien['nama_lengkap'] }}</p>
    <p>No RM: {{ $pasien['no_rm'] }}</p>
    <p>No Antrian: {{ $data['no_antrian'] }}</p>
    <p>Tujuan Poli: {{ $data['tujuan'] }}</p>
    <p>Tanggal Antrian: {{ $data['tanggal_antrian'] }}</p>

    <h2>Surat Eligibilitas</h2>
    <p>Dengan ini pasien atas nama {{ $pasien['nama_lengkap'] }} dengan No RM {{ $pasien['no_rm'] }} telah terdaftar di poli {{ $data['tujuan'] }}.</p>
</body>
</html>