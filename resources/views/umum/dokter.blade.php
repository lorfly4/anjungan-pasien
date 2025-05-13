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

            {{-- <form action="{{ url('/umum/print') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="tujuan" class="block text-sm font-medium text-gray-700">Pilih Tujuan Poli:</label>
                    <select name="tujuan" id="tujuan" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        <option value="">Pilih tujuan poli</option>
                        <option value="Poli Umum">Poli Umum</option>
                        <option value="Poli Gigi">Poli Gigi</option>
                        <option value="Poli Anak">Poli Anak</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white text-sm font-semibold px-4 py-2 rounded shadow hover:bg-blue-700">
                    Print
                </button>
            </form> --}}
        </section>
        &nbsp;
        <section class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="flex items-center bg-white rounded shadow px-4 py-3">
             <img alt="Avatar icon of a person with short hair and light skin tone" class="w-8 h-8 rounded-full mr-3" height="32" src="https://storage.googleapis.com/a1aa/image/bdda96c4-e18c-4bb1-5096-17648609155d.jpg" width="32"/>
             <div class="flex-1 text-sm font-semibold text-gray-700">
              Dr. Axel Aaron Giordano
             </div>
             <div class="text-xs text-gray-500 flex items-center space-x-1">
              <i class="fas fa-user-md">
              </i>
              <span>
               Doctor
              </span>
             </div>
            </div>
            <div class="flex items-center bg-white rounded shadow px-4 py-3">
             <img alt="Avatar icon of a man with short hair and medium skin tone wearing medical scrubs" class="w-8 h-8 rounded-full mr-3" height="32" src="https://storage.googleapis.com/a1aa/image/771de25b-9378-41d2-4ecc-5b219282d3fd.jpg" width="32"/>
             <div class="flex-1 text-sm font-semibold text-gray-700">
              Eng. Bendicho Quintero
             </div>
             <div class="text-xs text-gray-500 flex items-center space-x-1">
              <i class="fas fa-cogs">
              </i>
              <span>
               Engineer
              </span>
             </div>
            </div>
            <div class="flex items-center bg-white rounded shadow px-4 py-3">
             <img alt="Avatar icon of a woman with medium skin tone and long hair" class="w-8 h-8 rounded-full mr-3" height="32" src="https://storage.googleapis.com/a1aa/image/73277d2c-6dd2-43f2-4636-4b96c3d5d069.jpg" width="32"/>
             <div class="flex-1 text-sm font-semibold text-gray-700">
              Anna Williams
             </div>
             <div class="text-xs text-gray-500 flex items-center space-x-1">
              <i class="fas fa-user-nurse">
              </i>
              <span>
               Nurse
              </span>
             </div>
            </div>
            <div class="flex items-center bg-white rounded shadow px-4 py-3">
             <img alt="Avatar icon of a man with dark skin tone and short hair" class="w-8 h-8 rounded-full mr-3" height="32" src="https://storage.googleapis.com/a1aa/image/9aecaebf-8f73-4bd3-3513-75b634334c51.jpg" width="32"/>
             <div class="flex-1 text-sm font-semibold text-gray-700">
              John Miller
             </div>
             <div class="text-xs text-gray-500 flex items-center space-x-1">
              <i class="fas fa-stethoscope">
              </i>
              <span>
               Therapist
              </span>
             </div>
            </div>
           </section>
    </main>
</body>
</html>