<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>Metro CIKUPA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
    </style>
</head>
<body class="bg-gray-200 font-['Roboto']">
    <header class="flex items-center justify-center py-4">
        <img alt="Metro CKUPA logo with blue and yellow bars" class="h-10" height="40" src="https://storage.googleapis.com/a1aa/image/09742e36-67ef-4b95-e598-5eb6ea1bc463.jpg" width="120"/>
    </header>
    <main class="max-w-4xl mx-auto px-4">
        <div class="flex justify-between items-center mb-6">
            <a href="{{ url()->previous() }}" class=" flex items-center bg-blue-600 text-white text-sm font-semibold px-3 py-1 rounded">
                <i class="fas fa-arrow-left mr-2"></i>
                Back
            </a>
                </div>
        <section class="bg-white rounded shadow p-6">
            <h1 class="text-xl font-bold text-gray-700 mb-4">Registrasi Pasien</h1>
            <p class="text-sm text-gray-600 mb-2">Nama: <span class="font-semibold">{{ $pasien['nama_lengkap'] }}</span></p>
            <p class="text-sm text-gray-600 mb-2">No RM: <span class="font-semibold">{{ $pasien['no_rm'] }}</span></p>
            <p class="text-sm text-gray-600 mb-4">NIK: <span class="font-semibold">{{ $pasien['nik'] }}</span></p>
            <p class="text-sm text-gray-600 mb-4">Tujuan Poli: <span class="font-semibold">{{ $poli }}</span></p>
        </section>
        &nbsp;

        <form action="/umum/print" method="POST">
    @csrf
    <section class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="flex items-center bg-white rounded shadow px-4 py-3 cursor-pointer" onclick="submitForm('Dr. Rizky Putra, SpA')">
            <img alt="Avatar icon of Dr. Rizky Putra" class="w-8 h-8 rounded-full mr-3" height="32" src="https://via.placeholder.com/40" width="32"/>
            <div class="flex-1 text-sm font-semibold text-gray-700">Dr. Rizky Putra, SpA</div>
            <div class="text-xs text-gray-500 flex items-center space-x-1">
                <i class="fas fa-user-md"></i>
                <span>Doctor</span>
            </div>
        </div>
        <div class="flex items-center bg-white rounded shadow px-4 py-3 cursor-pointer" onclick="submitForm('Dr. Tania Putri, SpM')">
            <img alt="Avatar icon of Dr. Tania Putri" class="w-8 h-8 rounded-full mr-3" height="32" src="https://via.placeholder.com/40" width="32"/>
            <div class="flex-1 text-sm font-semibold text-gray-700">Dr. Tania Putri, SpM</div>
            <div class="text-xs text-gray-500 flex items-center space-x-1">
                <i class="fas fa-user-md"></i>
                <span>Doctor</span>
            </div>
        </div>
        <div class="flex items-center bg-white rounded shadow px-4 py-3 cursor-pointer" onclick="submitForm('Dr. Muhammad Firdaus, SpKJ')">
            <img alt="Avatar icon of Dr. Muhammad Firdaus" class="w-8 h-8 rounded-full mr-3" height="32" src="https://via.placeholder.com/40" width="32"/>
            <div class="flex-1 text-sm font-semibold text-gray-700">Dr. Muhammad Firdaus, SpKJ</div>
            <div class="text-xs text-gray-500 flex items-center space-x-1">
                <i class="fas fa-user-md"></i>
                <span>Doctor</span>
            </div>
        </div>
    </section>
    <input type="hidden" name="dokter" id="dokter-input">
</form>
        <script>
            function submitForm(dokter) {
                document.getElementById('dokter-input').value = dokter;
                document.querySelector('form').submit();
            }
        </script>
    </main>
</body>
</html>