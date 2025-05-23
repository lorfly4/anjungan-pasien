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
    <button aria-label="Back" class="bg-blue-600 text-white px-3 py-1 rounded flex items-center space-x-1">
     <i class="fas fa-arrow-left">
     </i>
     <span>
      Back
     </span>
    </button>
    <button aria-label="Home" class="bg-blue-600 text-white px-3 py-1 rounded flex items-center space-x-1">
     <i class="fas fa-home">
     </i>
     <span>
      Home
     </span>
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
   <form action="/umum/dokter" method="POST">
    @csrf
    <div class="grid grid-cols-4 gap-3">
        <div class="bg-white border border-gray-300 rounded-md flex flex-col items-center justify-center p-4 cursor-pointer hover:shadow-md" onclick="submitForm('POLI ANAK')">
            <img alt="Icon representing service 1 with blue and white colors" class="mb-2" height="60" src="https://storage.googleapis.com/a1aa/image/22570a02-842b-42d0-6843-2fbeed40ffc0.jpg" width="60"/>
            <span class="text-xs text-center text-gray-700">POLI ANAK</span>
        </div>
        <div class="bg-white border border-gray-300 rounded-md flex flex-col items-center justify-center p-4 cursor-pointer hover:shadow-md" onclick="submitForm('POLI JANTUNG')">
            <img alt="Icon representing service 2 with blue and white colors" class="mb-2" height="60" src="https://storage.googleapis.com/a1aa/image/55c4509a-e6a9-4aa0-03fc-ea92f2eea4fe.jpg" width="60"/>
            <span class="text-xs text-center text-gray-700">POLI JANTUNG</span>
        </div>
        <div class="bg-white border border-gray-300 rounded-md flex flex-col items-center justify-center p-4 cursor-pointer hover:shadow-md" onclick="submitForm('POLI UMUM')">
            <img alt="Icon representing service 3 with blue and white colors" class="mb-2" height="60" src="https://storage.googleapis.com/a1aa/image/c0e3b8e6-ac6a-4b32-f1e1-ab5c0514190f.jpg" width="60"/>
            <span class="text-xs text-center text-gray-700">POLI UMUM</span>
        </div>
        <div class="bg-white border border-gray-300 rounded-md flex flex-col items-center justify-center p-4 cursor-pointer hover:shadow-md" onclick="submitForm('POLI GIGI')">
            <img alt="Icon representing service 4 with blue and white colors" class="mb-2" height="60" src="https://storage.googleapis.com/a1aa/image/b33b96ea-3a2e-447d-4b7f-1c7580ec92f4.jpg" width="60"/>
            <span class="text-xs text-center text-gray-700">POLI GIGI</span>
        </div>
        <!-- Tambahkan elemen lainnya sesuai kebutuhan -->
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