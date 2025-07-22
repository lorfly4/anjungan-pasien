<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>
        RS Queue Layout
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        window.onload = function() {
            // Update waktu
            function updateDateTime() {
                const now = new Date();
                const options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                const dateStr = now.toLocaleDateString(undefined, options);
                const timeStr = now.toLocaleTimeString();
                document.getElementById('date-time').textContent = `${dateStr} ${timeStr}`;
            }

            updateDateTime();
            setInterval(updateDateTime, 1000);

            // Auto scroll vertical
            const scrollBoxV = document.getElementById('scrollBoxVertical');
            let scrollingDown = true;
            let isPausedV = false;
            let intervalV;

            function startScrollV() {
                intervalV = setInterval(() => {
                    if (isPausedV) return;

                    if (scrollingDown) {
                        scrollBoxV.scrollBy({
                            top: 2,
                            behavior: 'smooth'
                        });

                        if (scrollBoxV.scrollTop + scrollBoxV.clientHeight >= scrollBoxV.scrollHeight) {
                            pauseScrollV(false);
                        }
                    } else {
                        scrollBoxV.scrollBy({
                            top: -2,
                            behavior: 'smooth'
                        });

                        if (scrollBoxV.scrollTop <= 0) {
                            pauseScrollV(true);
                        }
                    }
                }, 50);
            }

            function pauseScrollV(nextDirection) {
                isPausedV = true;
                clearInterval(intervalV);
                setTimeout(() => {
                    scrollingDown = nextDirection;
                    isPausedV = false;
                    startScrollV();
                }, 2000);
            }

            startScrollV();



        };
    </script>

        <div class="fixed bottom-5 right-5 z-10">
            <button class="bg-[#5FABA3] text-white rounded-full p-3 shadow-lg hover:shadow-xl"
                onclick="toggleFullScreen()">
                <i class="fas fa-expand" id="fullscreen-icon"></i>
            </button>
        </div>
        <script>
            function toggleFullScreen() {
                if (!document.fullscreenElement) {
                    document.documentElement.requestFullscreen();
                    document.getElementById('fullscreen-icon').classList.remove('fa-expand');
                    document.getElementById('fullscreen-icon').classList.add('fa-compress');
                } else {
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    }
                    document.getElementById('fullscreen-icon').classList.remove('fa-compress');
                    document.getElementById('fullscreen-icon').classList.add('fa-expand');
                }
            }
        </script>




</head>

<body class="bg-white font-sans max-h-screen flex flex-col">
    <!-- Header -->
    <header class="flex justify-between items-center p-3 bg-[#323949] font-bold">
        <div class="flex items-center space-x-3">
            <img alt="Hospital logo placeholder" class="w-10 h-10" height="40"
                src="https://storage.googleapis.com/a1aa/image/5a75602b-8737-4946-7dec-48d7ef4960ed.jpg"
                width="40" />
            <span class="text-lg font-semibold text-white">
                Rumah Jiwa Sehat
            </span>
        </div>
        <div class="flex flex-col items-end space-y-1 text-white">
            <div class="text-sm font-normal" id="date-time">
            </div>

        </div>    </header>

    <!-- Main content area -->
    <main class="grid grid-cols-2 gap-4 h-screen p-4 bg-gray-100">

        <!-- Left half: Table -->
    {{-- <div wire:poll.5s> --}}
        <section class="max-h-[798px] overflow-x-hidden rounded " id="scrollBoxVertical">

            {{--  Header-table --}}
            <div class="grid grid-cols-3 sticky top-0 h-[124px]">
                <div class="col-span-2 bg-[#323949] flex items-center justify-center ">
                    <h1 class="text-2xl text-white font-bold">NAMA PASIEN</h1>
                </div>
                <div class="bg-[#6796B4] flex items-center justify-center ">
                    <h1 class="text-2xl text-white font-bold">NO. ANTRIAN</h1>
                </div>
            </div>


            {{-- content-table --}}
            @forelse ($antrianBelumDipanggil as $index => $antrianItem)
                <div class="grid grid-cols-3 auto-rows-[124px]">
                    <div class="col-span-2 bg-[#6796B4] p-3 px-5 flex flex-col justify-between border-t-2">
                        <p class="text-3xl text-white font-bold">{{ $antrianItem->nama_pasien }}</p>
                        <div class='justify-between flex'>
                            <p class="text-2xl  text-white font-bold ">
                                {{ \Carbon\Carbon::parse(time: $antrianItem->created_at)->format(format: 'd-m-Y H:i') }}
                            </p>
                            <p class='text-2xl font-bold text-[#323949]'>
                                {{ $antrianItem->dipanggil ? 'Sudah' : 'Belum' }}</p>
                        </div>
                    </div>
                    <div class="bg-[#323949] flex items-center justify-center border-t-2 ">
                        <h1 class="text-6xl font-bold text-white">{{ $antrianItem->no_antrian }}</h1>
                    </div>
                </div>
            @empty
                <div class="grid grid-cols-3 auto-rows-[124px]">
                    <div class="col-span-2 bg-[#6796B4] p-3 px-5 flex flex-col justify-between border-t-2">
                        <p class="text-3xl text-white font-bold">-</p>
                        <div class='justify-between flex'>
                            <p class="text-xl font-bold text-white">-</p>
                            <p class='text-2xl font-bold text-[#323949]'>-</p>
                        </div>
                    </div>
                    <div class="bg-[#323949] flex items-center justify-center border-t-2 ">
                        <h1 class="text-6xl font-bold text-white">-</h1>
                    </div>
                </div>
            @endforelse
        </section>
    </div>
        <!-- Right side: Videotron and below it carousel and field -->
        <section class="grid grid-rows-[1fr_190px_1fr] gap-5 ">
            <!-- Videotron 1/4 screen height -->
            <!-- Videotron 1/4 screen height -->
            <div class="border border-black h-[25vh] flex flex-col space-y-4 items-center justify-center">
                @foreach ($videos as $video)
                    <div class="w-full h-full flex items-center justify-center">
                        @if ($video->type == 'local')
                            <video class="w-full h-full object-cover" controls autoplay muted>
                                <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @elseif($video->type == 'youtube')
                            @php
                                // Ubah URL menjadi embed dan tambahkan parameter autoplay=1
                                $embedUrl = str_replace('watch?v=', 'embed/', $video->path);

                                // Tambahkan tanda ? atau & tergantung apakah sudah ada query string
                                $embedUrl .= (str_contains($embedUrl, '?') ? '&' : '?') . 'autoplay=1&mute=1';
                            @endphp
                            <div
                                class="border border-black h-[25vh] flex flex-col space-y-4 items-center justify-center">
                                <iframe width="320" height="240" src="{{ $embedUrl }}" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                        @else
                            <p class="text-gray-600">Jenis video tidak dikenal</p>
                        @endif
                    </div>
                @endforeach
            </div>


            <div class="w-full max-w-[600px] mx-auto flex gap-3 overflow-x-hidden" id="scrollBoxHorizontal">
                @for ($i = 0; $i < 2; $i++) {{-- Ulangi 2x agar bisa looping --}}
                    @foreach ($lokets as $index => $loket)
                        <div
                            class="min-w-[220px] {{ $index % 2 == 0 ? 'bg-[#455863]' : 'bg-[#4C6E84]' }} rounded content-center h-[170px] flex flex-col justify-center items-center">
                            <p class="text-center text-white font-bold text-2xl">
                                <span class="text-5xl">{{ $index + 1 }}</span><br />
                                {{ strtoupper($loket->nama_lokets) }}<br />
                                @foreach ($loket->polis as $poli)
                                    <span class="block text-base font-semibold">{{ $poli->nama_poli ?? 'POLI' }}</span>
                                @endforeach
                            </p>
                        </div>
                    @endforeach
                @endfor
            </div>

            <script>
                const scrollBox = document.getElementById('scrollBoxHorizontal');

                // Clone semua isi di dalam scrollBox
                const clone = scrollBox.innerHTML;
                scrollBox.innerHTML += clone;

                let scrollSpeed = 1;

                function autoScroll() {
                    scrollBox.scrollLeft += scrollSpeed;

                    // Jika sudah mencapai setengah dari total scroll (karena isinya dikloning)
                    if (scrollBox.scrollLeft >= scrollBox.scrollWidth / 2) {
                        scrollBox.scrollLeft = 0; // Reset ke awal
                    }

                    requestAnimationFrame(autoScroll);
                }

                autoScroll();
            </script>








            <!-- Field for keterangan nomor antrian yang akan dipanggil -->
            <div class="">
                {{-- Pesan Flash --}}
                @if (session('success'))
                    <p style="color: green;" id="flash-success">{{ session('success') }}</p>
                @endif

                <div class="grid grid-cols-[1fr_190px] rounded h-full text-center text-white">
                    <div class="grid grid-rows-3 bg-[#5FABA3]">
                        @if (isset($antrian))
                            <div class="row-span-2 self-center">
                                <p class="text-3xl font-bold-600">{{ $antrian->nama_pasien }}</p>
                                <h1 class="text-9xl font-bold">{{ $antrian->no_antrian }}</h1>
                            </div>

                            <div class="bg-[#517D98] text-4xl font-bold p-2 mt-4 content-center">
                                <p>MENUJU KE LOKET :</p>
                            </div>
                    </div>

                    <div>
                        <div class="text-[40px] bg-[#323949] content-center font-bold h-full">
                            {{ $antrian->loket->nama_lokets ?? '-' }}
                        </div>
                    </div>
                @else
                    <div class="row-span-2 self-center">
                        <p class="text-xl font-bold-600"></p>
                        <h1 class="text-9xl font-bold">-</h1>
                    </div>

                    <div class="bg-[#517D98] text-4xl font-bold p-2 mt-4 content-center">
                        <p>MENUJU KE LOKET :</p>
                    </div>
                </div>

                <div>
                    <div class="text-[40px] bg-[#323949] content-center font-bold h-full">
                        -
                    </div>
                </div>
                @endif
            </div>


        </section>
    </main>



</body>

</html>
