<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Metro Cikupa</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto&amp;display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: "Roboto", sans-serif;
    }

    .pattern-stripe {
      background-image: radial-gradient(circle at top right, white 0%, transparent 60%);
      background-repeat: no-repeat;
      background-position: top right;
    }

    .pattern-stripe-reverse {
      background-image: radial-gradient(circle at top left, white 0%, transparent 60%);
      background-repeat: no-repeat;
      background-position: top left;
    }
  </style>
  @if (session('success') || session('error'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @endif
</head>

<body class="bg-gray-100 min-h-screen flex flex-col items-center">
  <header class="w-full bg-gray-200 py-3 px-4 flex items-center justify-between">
    <div class="flex items-center justify-between w-full">
      <img src="{{ asset('img/rumah-sakit.png') }}" alt="Logo Rumah Sakit" class="h-13">
      <h1 class="text-gray-600 text-xl" style="font-size: 120%;">
        Daftar layanan
      </h1>
      <img src="{{ asset('img/bpjs.png') }}" alt="Logo BPJS Kesehatan" class="h-13">
    </div>
  </header>
  <main class="w-full max-w-6xl px-4 py-6">
    <form action="/umum" method="POST">
      @csrf
      <div class="grid grid-cols-2 gap-8 w-full max-w-5xl px-10 mt-6">
        <!-- Tombol Pasien Lama -->
        <button type="submit" name="validasi" value="lama"
          class="relative bg-blue-600 text-white rounded-lg shadow-lg h-40 flex items-center justify-center text-2xl font-semibold pattern-stripe overflow-hidden mx-10 w-full">
          <div class="flex items-center space-x-4 z-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5.121 17.804A13.937 13.937 0 0112 15c2.637 0 5.084.76 7.121 2.063M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span>Pasien Lama</span>
          </div>
          <!-- Dekorasi garis -->
          <div class="absolute top-0 right-0 w-24 h-full flex items-start justify-end pr-2 pt-4 opacity-50">
            <div class="w-6 h-24 bg-white rounded-full mx-0.5"></div>
            <div class="w-4 h-20 bg-white rounded-full mx-0.5"></div>
            <div class="w-2 h-16 bg-white rounded-full mx-0.5"></div>
          </div>
        </button>
        <!-- Tombol Pasien Baru -->
        <button type="submit" name="validasi" value="baru"
          class="relative bg-purple-700 text-white rounded-lg shadow-lg h-40 flex items-center justify-center text-2xl font-semibold pattern-stripe-reverse overflow-hidden mx-10 w-full">
          <div class="flex items-center space-x-4 z-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 11c0 3.866-3.134 7-7 7M12 11c0 3.866 3.134 7 7 7M12 11V5m0 0L9 8m3-3l3 3" />
            </svg>
            <span>Pasien Baru</span>
          </div>
          <!-- Dekorasi garis -->
          <div class="absolute top-0 left-0 w-24 h-full flex items-start justify-start pl-2 pt-4 opacity-50">
            <div class="w-6 h-24 bg-white rounded-full mx-0.5"></div>
            <div class="w-4 h-20 bg-white rounded-full mx-0.5"></div>
            <div class="w-2 h-16 bg-white rounded-full mx-0.5"></div>
          </div>
        </button>
        <!-- Tombol Print -->
        <a href="/print"
          class="relative bg-purple-700 text-white rounded-lg shadow-lg h-40 flex items-center justify-center text-2xl font-semibold pattern-stripe-reverse overflow-hidden mx-10">
          <div class="flex items-center space-x-4 z-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 11c0 3.866-3.134 7-7 7M12 11c0 3.866 3.134 7 7 7M12 11V5m0 0L9 8m3-3l3 3" />
            </svg>
            <span>Print</span>
          </div>
          <!-- Dekorasi garis -->
          <div class="absolute top-0 left-0 w-24 h-full flex items-start justify-start pl-2 pt-4 opacity-50">
            <div class="w-6 h-24 bg-white rounded-full mx-0.5"></div>
            <div class="w-4 h-20 bg-white rounded-full mx-0.5"></div>
            <div class="w-2 h-16 bg-white rounded-full mx-0.5"></div>
          </div>
        </a>
      </div>
    </form>
  </main>
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
</body>

</html>