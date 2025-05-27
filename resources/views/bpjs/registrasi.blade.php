<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
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
  </style>
 </head>
 <body class="bg-gray-100 min-h-screen flex flex-col items-center">
  <header class="w-full bg-gray-200 py-3 px-4 flex items-center justify-between">
   <div class="flex items-center space-x-2">
    <button type="button" aria-label="Back" class="bg-blue-600 text-white px-3 py-1 rounded flex items-center space-x-1">
     <i class="fas fa-arrow-left"></i>
     <a href="{{ url()->previous() }}"  >Kembali</a>
    </button>
   </div>
   <div class="flex flex-col items-center">
    <img alt="Metro Cikupa logo with blue and yellow colors" class="h-10 object-contain" height="40" src="https://storage.googleapis.com/a1aa/image/3e10613f-2a67-4247-cbde-86f08d72d732.jpg" width="120"/>
    <span class="text-gray-600 text-sm mt-1">
     Daftar layanan
    </span>
   </div>
   <div class="w-16">
   </div>
  </header>
  <main class="w-full max-w-6xl px-4 py-6">
   <form class="mb-4 flex justify-center" role="search" aria-label="Search service code" method="post" action="">
    @csrf
    <input aria-label="Search service code" class="border border-gray-300 rounded-l px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" name="search" placeholder="Cari melalui kode layanan" type="search"/>
    <button aria-label="Submit search" class="bg-blue-600 text-white px-4 py-1 rounded-r hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500" type="submit">
     Submit
    </button>
   </form>
   <form action="/bpjs/dokter" method="POST">
    @csrf
    <div class="grid grid-cols-4 gap-3">
        @foreach($poli as $p)
            <div class="bg-white border border-gray-300 rounded-md flex flex-col items-center justify-center p-4 cursor-pointer hover:shadow-md" onclick="submitForm('{{ $p->id_poli }}')">
                <img alt="Icon representing {{ $p->nama_poli }} with blue and white colors" class="mb-2" height="60" src="{{ asset('/img/rumah-sakit.png') }}" width="60"/>
                <span class="text-xs text-center text-gray-700">{{ $p->nama_poli }}</span>
            </div>
        @endforeach
    </div>
    <input type="hidden" name="poli" id="poli-input">
    <script>
    function submitForm(poli) {
        // Pastikan elemen input tersembunyi ditemukan
        const poliInput = document.getElementById('poli-input');
        if (!poliInput) {
            console.error('Input tersembunyi tidak ditemukan!');
            return;
        }

        // Isi nilai input tersembunyi dengan nama poli
        poliInput.value = poli;

        // Pastikan form ditemukan dan dikirimkan
        const form = poliInput.closest('form');
        if (!form) {
            console.error('Form tidak ditemukan!');
            return;
        }

        form.submit(); // Kirim form
    }
</script> 
   </form>
   
  </main>
 </body>
</html>