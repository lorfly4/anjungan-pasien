<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>
        RS Queue Layout
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
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
            <div class="border border-black h-20 flex items-center justify-center space-x-4 overflow-x-auto px-2">
                <div
                    class="w-16 h-16 border border-black flex items-center justify-center text-base font-normal flex-shrink-0">
                    8
                </div>
                <div
                    class="w-16 h-16 border border-black flex items-center justify-center text-base font-normal flex-shrink-0">
                    9
                </div>
                <div
                    class="w-16 h-16 border border-black flex items-center justify-center text-base font-normal flex-shrink-0">
                    10
                </div>
                <div
                    class="w-16 h-16 border border-black flex items-center justify-center text-base font-normal flex-shrink-0">
                    11
                </div>
                <div
                    class="w-16 h-16 border border-black flex items-center justify-center text-base font-normal flex-shrink-0">
                    12
                </div>
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

@php
    use App\Models\RiwayatAntrians;

    $antriansDipanggil = RiwayatAntrians::where('dipanggil', 1)->get();
@endphp

<div class="border border-black h-16 flex items-center justify-center text-base font-normal px-4">
    @if ($antriansDipanggil->isNotEmpty())
        @foreach ($antriansDipanggil as $antrian)
            <div class="mt-6 bg-green-100 p-4 rounded-lg text-center">
                <h3 class="text-xl font-semibold">
                    Dipanggil: <span id="nama-antrian" class="text-green-800">{{ $antrian->no_antrian }}</span> -
                    Loket: <span id="loket-antrian" class="text-green-800">{{ $antrian->loket->nama_lokets }}</span>
                </h3>
            </div>
        @endforeach
    @else
        <p>Tidak ada antrian yang sudah dipanggil.</p>
    @endif
</div>


            </div>


        </section>
    </main>
    <!-- Footer -->
    <footer class="border-t border-black p-3 text-xs font-normal text-center bg-sky-400 text-white">
        Catatan kaki saja
    </footer>


</body>

</html>
