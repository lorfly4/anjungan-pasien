<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Anjungan Pasien Mandiri</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
  />
</head>
<body class="bg-white">
  <div class="max-w-full px-8 py-16">
    <div class="flex items-center justify-center">
      <h1 class="text-black font-extrabold text-[64px] leading-[72px] font-sans mb-20">
        ANJUNGAN PASIEN MANDIRI
      </h1>
    </div>
    <form action="/bpjs/baru" method="POST">
        @csrf
        <div class="flex justify-between max-w-5xl mx-auto gap-8 flex-wrap">
          <input
            class="bg-[#3DB4FF] rounded-[32px] px-16 py-3 flex-1 max-w-[35%] min-w-[220px] ml-[-20px] text-left text-white font-extrabold text-[20px] leading-[28px] font-sans uppercase"
            type="submit"
            name="validasi"
            value="Rujukan Rumah Sakit"
          >
          <input
            class="bg-[#3DB4FF] rounded-[32px] px-20 py-12 flex-1 max-w-[40%] min-w-[280px] text-white font-extrabold text-[32px] leading-[40px] font-sans uppercase"
            type="submit"
            name="validasi"
            value="BPJS"
          >
          <input
            class="bg-[#3DB4FF] rounded-[32px] px-20 py-12 flex-1 max-w-[40%] min-w-[280px] text-white font-extrabold text-[24px] leading-[36px] font-sans uppercase"
            type="submit"
            name="validasi"
            value="Daftar Baru"
          >
        </div>
    </form>
  </div>
</body>
</html>