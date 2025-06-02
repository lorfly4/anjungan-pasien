<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Metro CIKUPA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
    </style>
</head>

<body class="bg-gray-200 font-['Roboto']">
    <header class="flex items-center justify-center py-4">
        <img alt="Metro CKUPA logo with blue and yellow bars" class="h-10" height="40"
            src="https://storage.googleapis.com/a1aa/image/09742e36-67ef-4b95-e598-5eb6ea1bc463.jpg" width="120" />
    </header>
    <main class="max-w-4xl mx-auto px-4">
        <div class="flex justify-between items-center mb-6">
            <a href="{{ url()->previous() }}"
                class=" flex items-center bg-blue-600 text-white text-sm font-semibold px-3 py-1 rounded">
                <i class="fas fa-arrow-left mr-2"></i>
                Back
            </a>
        </div>
        <section class="bg-white rounded shadow p-6">
            <h1 class="text-xl font-bold text-gray-700 mb-4">Registrasi Pasien</h1>
            <p class="text-sm text-gray-600 mb-2">Nama: <span class="font-semibold">{{ $pasien['nama_lengkap'] }}</span>
            </p>
            <p class="text-sm text-gray-600 mb-2">No RM: <span class="font-semibold">{{ $pasien['no_rm'] }}</span></p>
            <p class="text-sm text-gray-600 mb-4">NIK: <span class="font-semibold">{{ $pasien['nik'] }}</span></p>
            <p class="text-sm text-gray-600 mb-4">Tujuan Poli: <span class="font-semibold">{{ $poli->nama_poli }}</span>
            </p>
        </section>
        &nbsp;

<div class="max-w-xl mx-auto mt-8 bg-white p-6 rounded shadow">
    <h2 class="text-lg font-bold mb-4">Pilih Jadwal Dokter: {{ $dokter->nama_dokter }}</h2>
    <form action="/umum/print" method="POST">
        @csrf
        <input type="hidden" name="dokter" value="{{ $dokter->id_dokter }}">
        <div class="grid grid-cols-1 gap-4">
            @foreach($jadwal as $j)
                <div>
                    <label>
                        <input type="radio" name="jadwal" value="{{ $j['hari'] }}|{{ $j['jam'] }}" {{ $j['disable'] ? 'disabled' : '' }}>
                        {{ $j['hari'] }} - {{ $j['jam'] }}
                        @if($j['disable'])
                            <span class="text-red-500">(Sudah diambil)</span>
                        @endif
                    </label>
                </div>
            @endforeach
        </div>
        <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded" {{ count(array_filter($jadwal, fn($j) => !$j['disable'])) == 0 ? 'disabled' : '' }}>
            Lanjutkan
        </button>
    </form>
</div>