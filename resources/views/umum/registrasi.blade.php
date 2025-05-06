{{-- filepath: c:\Users\ADDO\Desktop\anjungan_pasien\resources\views\umum\registrasi.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>Registrasi Pasien</title>
</head>
<body>
    <h1>Registrasi Pasien</h1>
    <p>Nama: {{ $pasien['nama_lengkap'] }}</p>
    <p>No RM: {{ $pasien['no_rm'] }}</p>
    <p>NIK: {{ $pasien['nik'] }}</p>

    <form action="{{ url('/umum/print') }}" method="POST">
        @csrf
        <label for="tujuan">Pilih Tujuan Poli:</label>
        <select name="tujuan" id="tujuan" required>
            <option value="">Pilih tujuan poli</option>
            <option value="Poli Umum">Poli Umum</option>
            <option value="Poli Gigi">Poli Gigi</option>
            <option value="Poli Anak">Poli Anak</option>
        </select>
        <br><br>
        <button type="submit">Print</button>
    </form>
</body>
</html>