<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>
        RS Queue Layout
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        // Script to update date/time every second
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
        setInterval(updateDateTime, 1000);
        window.onload = updateDateTime;
    </script>
</head>

<body class="bg-white font-sans min-h-screen flex flex-col">
    <!-- Header -->
    <header class="flex justify-between items-center p-3 bg-sky-400 text-white">
        <div class="flex items-center space-x-3">
            <img alt="Hospital logo placeholder" class="w-10 h-10" height="40"
                src="https://storage.googleapis.com/a1aa/image/5a75602b-8737-4946-7dec-48d7ef4960ed.jpg"
                width="40" />
            <span class="text-lg font-semibold">
                Nama RS
            </span>
        </div>
        <div class="flex flex-col items-end space-y-1">
            <div class="text-sm font-normal" id="date-time">
            </div>
            <button aria-label="Fullscreen" class="text-white text-xl">
                <i class="fas fa-expand">
                </i>
            </button>
        </div>
    </header>
    <!-- Main content area -->
    <main class="flex flex-grow p-4 space-x-4">
        <!-- Left half: Table -->
        <section class="w-1/2 border border-black">
            <table class="w-full border-collapse border border-black text-sm">
                <thead>
                    <tr>
                        <th class="border border-black px-2 py-1">
                            No
                        </th>
                        <th class="border border-black px-2 py-1">
                            No Antrian
                        </th>
                        <th class="border border-black px-2 py-1">
                            Loket Tujuan
                        </th>
                        <th class="border border-black px-2 py-1">
                            Nama Pasien
                        </th>
                        <th class="border border-black px-2 py-1">
                            Waktu Daftar
                        </th>
                        <th class="border border-black px-2 py-1">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($antrianBelumDipanggil as $index => $antrianItem)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $antrianItem->no_antrian }}</td>
                            <td>{{ $antrianItem->loket->nama_lokets ?? '-' }}</td>
                            <td>{{ $antrianItem->nama_pasien }}</td>
                            <td>{{ \Carbon\Carbon::parse($antrianItem->created_at)->format('d-m-Y H:i') }}</td>
                            <td>{{ $antrianItem->dipanggil ? 'Sudah' : 'Belum' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Tidak ada antrian yang belum dipanggil.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>
        <!-- Right side: Videotron and below it carousel and field -->
        <section class="flex flex-col w-1/2 space-y-4">
            <!-- Videotron 1/4 screen height -->
            <div class="border border-black h-[25vh] flex items-center justify-center text-lg font-normal">
                Videotron
            </div>
            <!-- Carousel nomor antrian selanjutnya -->
            <div id="loketCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($id_lokets as $index => $loket)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="d-flex justify-content-center align-items-center" style="height: 200px;">
                                <h3>ID Loket: {{ $loket->id_lokets }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#loketCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#loketCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>




            <!-- Field for keterangan nomor antrian yang akan dipanggil -->
            <div class="border border-black h-16 flex items-center justify-center text-base font-normal px-4">
                {{-- Pesan Flash --}}
                @if (session('success'))
                    <p style="color: green;" id="flash-success">{{ session('success') }}</p>
                    <script>
                        setTimeout(() => {
                            document.getElementById("flash-success").remove();
                        }, 3000);
                    </script>
                @endif

                {{-- Tampilan Data yang Dipanggil --}}
                @if (isset($antrian))
                    <h3>Dipanggil: <span id="nama-antrian">{{ $antrian->no_antrian }}</span> - Loket: <span
                            id="loket-antrian">{{ $antrian->loket->nama_lokets }}</span></h3>
                    <script>
                        // Fungsi Text-to-Speech
                        const loket = document.getElementById("loket-antrian").innerText;
                        const nama = document.getElementById("nama-antrian").innerText;
                        const msg = new SpeechSynthesisUtterance(`Nomor antrian ${nama}, silakan menuju ${loket}`);
                        msg.lang = "id-ID";
                        msg.rate = 0.8;
                        msg.pitch = 1;
                        msg.voice = window.speechSynthesis.getVoices().find(voice => voice.lang === "id-ID" && voice.name ===
                            "Google Indonesian Female");
                        window.speechSynthesis.speak(msg);
                    </script>
                @elseif (isset($nextAntrian))
                    <h3>Dipanggil: <span id="nama-antrian">{{ $nextAntrian->no_antrian }}</span> - Loket: <span
                            id="loket-antrian">{{ $nextAntrian->loket->nama_lokets }}</span></h3>
                @endif
            </div>


        </section>
    </main>
    <!-- Footer -->
    <footer class="border-t border-black p-3 text-xs font-normal text-center bg-sky-400 text-white">
        Catatan kaki saja
    </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
