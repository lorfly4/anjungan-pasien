<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
    Metro Cikupa
   </title>
   <script src="https://cdn.tailwindcss.com">
   </script>
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
</head>
<body class="rounded-none"> 
      <!-- MAIN HERO-->
      <main
        class="flex flex-col items-end pb-12 w-full min-h-[753px]  max-md:px-5 max-md:pt-20 max-md:max-w-full "
        role="main"
        aria-label="Medical and Healthcare homepage hero section"
      >
        <img
          src="{{ asset('/img/Main.png') }}" 
          alt="Medical facility background"
          class="absolute top-0.1 left-0 w-full h-[600px] object-cover rounded-b-[40px] z-[-1]"
          role="img"
        />

        <header class="relative w-full max-md:max-w-full ">
          <div class="flex gap-5 max-md:flex-col justify-between mx-10 mt-2">
            <div class="max-md:ml-0 max-md:w-full">
              <img
                src=""
                alt="Logo"
                class="object-contain shrink-0 mt-2.5 max-w-full aspect-[3.41] w-[239px] max-md:mt-10 ml-[-10px] bg-red-600"
              />
            </div>
            <h1 class='text-white font-medium text-3xl mt-5'>Daftar Pelayanan</h1>
            <div class="ml-5 w-max-md:ml-0 max-md:w-full ">
              <img
                src=""
                alt="logo"
                class="object-contain shrink-0 max-w-full aspect-square w-[105px] max-md:mt-10 "
              />
            </div>
          </div>
        </header>
        <section class="relative mt-48 text-8xl font-bold text-right text-white max-md:mt-10 max-md:mr-2.5 max-md:max-w-full max-md:text-4xl pt-15 pr-8 ">
          <h1 class="leading-tight text-6xl md:text-7xl max-md:text-4xl ">
            Medical & <br /> Healthcare
            <br />
          </h1>
          <h6 class='text-[20px] font-normal'>"Kesehatan adalah harta paling berharga yang sering dilupakan sampai <br /> tubuh memberi peringatan. Jagalah sebelum terlambat."</h6>
        </section>
      </main>

  
{{-- <div class="w-full max-w-6xl px-4 py-6"> --}}
 <!-- Konten Tombol -->
<div class='grid grid-cols-2 w-full h-auto mt-[-100px] place-items-center overflow-hidden'>
    
  <!-- Tombol Pasien Lama -->
     <a href="/bpjs" class="shadow-sm bg-[#687DA0] h-[285px] rounded-[38px] w-[643px] max-md:rounded-3xl max-md:h-[200px] max-md:w-[90%] max-sm:rounded-3xl max-sm:h-[150px] max-sm:w-[85%] px-10 py-5">
       <h1 class="text-6xl text-white h-[55px] p-[15px] max-md:h-auto max-md:text-4xl max-md:w-[70%] max-sm:w-4/5 max-sm:h-auto max-sm:text-3xl">
          Pasien BPJS
       </h1>
       <img src="{{ asset('/img/Medical1.png')}}" class='mt-[-195px] ml-[-5px] max-w-500'/> 
     </a>

  <!-- Tombol Pasien Umun/Baru -->
  <a href="/umum">
    <div class="shadow-sm bg-[#6795b4] h-[285px] rounded-[38px] w-[643px] max-md:rounded-3xl max-md:h-[200px] max-md:w-[90%] max-sm:rounded-3xl max-sm:h-[150px] max-sm:w-[85%] px-10 py-5 ">
      <h1 class="text-6xl text-white h-[55px] p-[15px] max-md:h-auto max-md:text-4xl max-md:w-[70%] max-sm:w-4/5 max-sm:h-auto max-sm:text-3xl">
        Pasien Umum
      </h1>
      <img src="{{ asset('/img/Medical2.png') }}" class='mt-[-195px] ml-[-5px] max-w-500'/> 
    </div>
  </a>
</div>
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
  @if (session('success') || session('error'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @endif
</div>
</body>
</html>

