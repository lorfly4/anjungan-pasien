<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Karcis Antrian</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body class="bg-white p-4 w-[300px] mx-auto border border-gray-300 rounded shadow">

    <div class="text-center mb-4">
        <img src="https://storage.googleapis.com/a1aa/image/8229eb58-f391-42a9-79c0-8b72bb0b1225.jpg" alt="Logo RS" class="w-16 h-16 mx-auto mb-2">
        <h1 class="text-lg font-bold text-gray-800">RUMAH SAKIT METRO CNRPA</h1>
        <p class="text-sm text-gray-600">Jl. Sehat No. 123, Kota Metro</p>
    </div>

    <div class="border-t border-b py-3 mb-4 text-sm text-gray-700">
        <p><span class="font-semibold">Nama:</span> {{ $pasien['nama_lengkap'] ?? '-' }}</p>
        <p><span class="font-semibold">NIK:</span> {{ $pasien['nik'] ?? '-' }}</p>
        <p><span class="font-semibold">No. RM:</span> {{ $pasien['no_rm'] ?? '-' }}</p>
        <p><span class="font-semibold">Poli:</span> {{ $poli ?? '-' }}</p>
        <p><span class="font-semibold">Dokter:</span> {{ $dokter ?? '-' }}</p>
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Nomor Antrian: {{ $data['no_antrian'] ?? '-' }}</h1>
        
        </div>

    <div class="flex justify-center mb-3">
        @php
            use SimpleSoftwareIO\QrCode\Facades\QrCode;
        @endphp
<img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data={{ $data['no_antrian'] }}" alt="QR Code">
    </div>

    <div class="text-center text-xs text-gray-600">
        <p>Terima kasih telah menggunakan layanan kami.</p>
        <p>Call Center: (0725) 123456</p>
    </div>

</body>
</html>

