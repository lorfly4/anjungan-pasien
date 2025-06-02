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
        <img src="https://storage.googleapis.com/a1aa/image/8229eb58-f391-42a9-79c0-8b72bb0b1225.jpg" alt="Logo RS"
            class="w-16 h-16 mx-auto mb-2">
        <h1 class="text-lg font-bold text-gray-800">RUMAH SAKIT METRO CNRPA</h1>
        <p class="text-sm text-gray-600">Jl. Sehat No. 123, Kota Metro</p>
    </div>

    <div class="border-t border-b py-3 mb-4 text-sm text-gray-700 flex justify-between">
        <span id="current-time" class="text-left"></span>
        <span id="current-date" class="text-right"></span>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const timeElement = document.getElementById('current-time');
            const dateElement = document.getElementById('current-date');

            function updateTimeAndDate() {
                const now = new Date();
                const time = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
                const date = now.toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric' });

                timeElement.textContent = time;
                dateElement.textContent = date;
            }

            updateTimeAndDate();
            setInterval(updateTimeAndDate, 1000); // Update every second
        });
    </script>


    <div class="border-t border-b py-3 mb-4 text-sm text-gray-700">
        <p class="text-2xl font-bold text-gray-800 mb-2 text-center"><span>Nomor Antrian: </span></p>
        <h1 class="text-3xl font-bold text-black-600 text-center">{{ $data['no_antrian'] }}</h1>
        <p class="hidden"><span class="font-semibold">Nama:</span> {{ $data['nama_lengkap'] ?? '-' }}</p>
        <p class="hidden"><span class="font-semibold">NIK:</span> {{ $data['nik'] ?? '-' }}</p>
        <p class="hidden"><span class="font-semibold">No. RM:</span> {{ $data['no_rm'] ?? '-' }}</p>
        <p class="hidden"><span class="font-semibold">Poli:</span> {{ $data['dokter'] ?? '-' }}</p>
        <p class="hidden"><span class="font-semibold">Dokter:</span> {{ $data['poli'] ?? '-' }}</p>

    </div>

    <div class="flex justify-center mb-3">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data={{ $data['no_antrian'] }}"
            alt="QR Code">
    </div>

    <div class="text-center text-xs text-gray-600">
        <p>Terima kasih telah menggunakan layanan kami.</p>
        <p>Call Center: (0725) 123456</p>
    </div>

        <form method="POST" action="/print/simpan">
        @csrf
        @foreach($data as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
        <button type="submit" class="w-full mt-4 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            onclick="handlePrintAndRedirect()">
            Konfirmasi Selesai Print
        </button>


        <script>
    function handlePrintAndRedirect() {
        window.print();
        // Redirect to the home page after printing
        window.onafterprint = function () {
            window.location.href = "/";
        };
    }
</script>



    </form>
</body>

</html>