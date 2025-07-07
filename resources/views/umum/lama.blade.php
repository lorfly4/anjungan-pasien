<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Metro CNRPA</title>
    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body class="bg-gray-100 font-sans min-h-screen flex flex-col items-center pt-8">
    <header class="flex items-center space-x-2 mb-12">
        <a href="{{ url()->previous() }}"
            class="absolute left-8 top-8 flex items-center text-blue-600 hover:text-blue-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>
        <img src="https://storage.googleapis.com/a1aa/image/8229eb58-f391-42a9-79c0-8b72bb0b1225.jpg" class="w-10 h-10"
            alt="Logo">
        <h1 class="text-lg font-semibold text-gray-700">Metro CNRPA</h1>
    </header>

    <main class="flex flex-col md:flex-row items-center space-y-6 md:space-y-0 md:space-x-6 w-full max-w-4xl px-4">
        <form method="POST" action="/umum/lama" class="flex flex-col space-y-4 flex-grow max-w-lg w-full">
            @csrf
            <input type="text" name="nomor" id="input-nik" placeholder="Masukkan NIK Anda"
                class="bg-white border border-gray-300 rounded-md py-2 px-4 text-center text-lg font-mono text-gray-700"
                required>
            <input type="date" name="tanggal" id="input-tanggal"
                class="bg-white border border-gray-300 rounded-md py-2 px-4 text-center text-lg font-mono text-gray-700"
                required>
            <div class="bg-blue-100 border border-blue-300 text-blue-700 py-2 px-4 text-center rounded-md text-sm">
                Please enter your details using the keypad on the right.
            </div>
            <button type="submit"
                class="bg-blue-500 text-white py-4 rounded-md font-semibold text-xl hover:bg-blue-700">submit</button>
        </form>

        <div class="grid grid-cols-3 gap-2 max-w-xs w-full">
            @for ($i = 1; $i <= 9; $i++)
                <button type="button" onclick="keypad('{{ $i }}')"
                    class="bg-white border border-gray-300 rounded-md py-4 text-xl font-semibold text-gray-700 hover:bg-gray-50">{{ $i }}</button>
            @endfor
            <button type="button" onclick="keypad('0')"
                class="bg-white border border-gray-300 rounded-md py-4 text-xl font-semibold text-gray-700 hover:bg-gray-50">0</button>
            <button type="button" onclick="hapusInput()"
                class="bg-red-500 text-white rounded-md py-4 text-xl font-semibold hover:bg-red-700">Hapus</button>
        </div>
    </main>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}"
            });
        @endif
    </script>


    <script>
            function keypad(angka) {
                const input = document.getElementById('input-nik');
                input.value += angka;
            }

        function hapusInput() {
            const input = document.getElementById('input-nik');
            input.value = input.value.slice(0, -1);
        }
    </script>
</body>

</html>