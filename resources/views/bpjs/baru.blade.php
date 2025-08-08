@include('sweetalert::alert')

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Metro Cikupa</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&amp;display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: "Roboto", sans-serif;
    }
    /* .pattern-stripe {
      background-image: radial-gradient(circle at top right, white 0%, transparent 60%);
      background-repeat: no-repeat;
      background-position: top right;
    }
    .pattern-stripe-reverse {
      background-image: radial-gradient(circle at top left, white 0%, transparent 60%);
      background-repeat: no-repeat;
      background-position: top left;
    } */
  </style>
  @if (session('success') || session('error'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @endif
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center">
   {{-- Logo --}}
  <div class='w-full flex-col '>

    <div class="flex justify-between mt-[-25px]">
      <!-- placeholder -->
      <img
        src=""
        alt="icon" class="object-contain max-w-full aspect-[4.41] w-[190px] max-md:mt-10 bg-red-500" />
        <!-- placeholder -->
      <img
        src=""
        alt="icon" class="object-contain mt-10 max-w-full aspect-[1.41] w-[200px] max-md:mt-10  " />
    </div>
  </div>
  <!-- Tombol Kembali- -->
  <div>
    <a href="/bpjs" class="items-start">
      <div
        class='bg-[#5e7291] hover:bg-[#4e617a] text-white px-4 py-2 relative rounded-xl shadow-md flex flex-col items-center space-y-2 w-[200px] mx-5'>
        <span class='text-4xl font-semibold mr-10'> <span class='absolute left-6 bottom-3 text-4xl'> 
          </span>Kembali</span>
      </div>
    </a>
  </div>
  <main class="">
    <form action="/bpjs/baru" method="POST">
      @csrf
      <div class="grid grid-cols-3 gap-8 w-full max-w-5xl px-10 mt-6">
        <!-- Tombol Pasien Lama -->
        <button type="submit" name="validasi" value="lama"
          class="bg-[#5e7291] hover:bg-[#4e617a] text-white px-10 py-20 rounded-3xl shadow-lg flex flex-col items-center justify-center space-y-4 ">  
          <img src="{{ asset('/img/Rujukan.png') }}" class="w-[370px] h-[370px] object-contain" />
          <span class="text-4xl font-bold">Rujukan Rumah Sakit</span>
        </button>
        <!-- Tombol Pasien Baru -->
        <button type="submit" name="validasi" value="baru"
          class="bg-[#6e88a1] hover:bg-[#5e758d] text-white px-10 py-20 rounded-3xl shadow-lg flex flex-col items-center justify-center space-y-4 ">
            <img src="{{ asset('/img/Daftar.png') }} " class="w-[370px] h-[370px] object-contain"/>
            <span class="text-4xl font-semibold">Daftar Baru</span> 
        </button>
      </div>
    </form>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: '{{ session('error') }}'
    });
</script>
@endif
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Gagal',
        text: '{{ session('success') }}'
    });
</script>
@endif
</body>
</html>