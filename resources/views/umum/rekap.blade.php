<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>
        Metro Cikupa Profile
    </title>
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-200 min-h-screen flex flex-col items-center justify-start py-10 px-4">
    <header class="w-full max-w-5xl flex items-center justify-center relative mb-10">
        <a class="absolute left-4 top-1/2 -translate-y-1/2 bg-blue-600 text-white px-4 py-2 rounded flex items-center gap-2 hover:bg-blue-700 transition"
            href="{{ url()->previous() }}">
            <i class="fas fa-arrow-left"></i>
            back
        </a>
        <div class="text-center">
            <div class="flex items-center justify-center gap-1 mb-1">
                <img alt="Metro Cikupa logo with blue and yellow squares" class="w-6 h-6" height="24"
                    src="https://storage.googleapis.com/a1aa/image/47ccaaf0-e3cd-4cfe-53ba-abe9b70be5b9.jpg"
                    width="24" />
                <span class="font-semibold text-lg text-gray-700">
                    Metro
                </span>
                <span class="font-semibold text-lg text-blue-600">
                    CIKUPA
                </span>
            </div>
            <p class="text-gray-600 text-sm">
                Data Pelapor
            </p>
            <p class="text-gray-500 text-xs">
                Pastikan data pelapor sudah benar
            </p>
        </div>
    </header>
    <main class="w-full max-w-5xl bg-white shadow-md rounded-md p-6 flex flex-col gap-6">
        <div class="flex gap-6">
            <div class="flex-shrink-0">
                @if ($data['jenis_kelamin'] === 'laki-laki')
                    <img alt="Cartoon style avatar of a person with short brown hair and green shirt" class="rounded"
                        height="120"
                        src="https://www.w3schools.com/w3images/avatar2.png"
                        width="120" />
                @else
                    <img alt="Cartoon style avatar of a woman with long brown hair and pink shirt" class="rounded"
                        height="120"
                        src="https://www.w3schools.com/w3images/avatar6.png"
                        width="120" />
                @endif
            </div>
            <div class="flex-grow flex flex-col justify-between text-gray-700 text-sm space-y-1">
                <p>
                    <span class="font-semibold">
                        NIK:
                    </span>
                    {{ $data['nik'] }}
                </p>
                <p>
                    <span class="font-semibold">
                        NAMA LENGKAP:
                    </span>
                    {{ $data['nama_lengkap'] }}
                </p>
                <p>
                    <span class="font-semibold">
                        ALAMAT:
                    </span>
                    {{ $data['alamat'] }}
                </p>
                <p>
                    <span class="font-semibold">
                        NO. HP:
                    </span>
                    {{ $data['no_hp'] }}
                </p>
            </div>
            <div class="flex-shrink-0 text-gray-700 text-sm space-y-1">
                <p>
                    <span class="font-semibold">
                        Tempat & Tanggal Lahir:
                    </span>
                    {{ $data['tempat_lahir'] }}, {{ $data['tanggal_lahir'] }}
                </p>
                <p>
                    <span class="font-semibold">
                        Jenis Kelamin:
                    </span>
                    {{ $data['jenis_kelamin'] }}
                </p>
                <p>
                    <span class="font-semibold">
                        Alamat:
                    </span>
                    {{ $data['alamat'] }}
                </p>
            </div>
        </div>
        <div class="text-right">
            <a href="/umum/registrasi"
                class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition text-sm">
                NEXT
            </a>
        </div>
    </main>
</body>

</html>