<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Panggil Antrian</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800 font-sans">

    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-xl">

        <h1 class="text-3xl font-bold mb-6 text-center text-green-600">Panggilan Antrian</h1>

        <div class="flex gap-4 mb-6 justify-center">
            <form action="{{ route('riwayatantrians.panggil') }}" method="POST">
                @csrf
                <button type="submit"
                    class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">Panggil Baru</button>
            </form>

            <form action="{{ route('riwayatantrians.panggil') }}" method="POST">
                @csrf
                <input type="hidden" name="ulang" value="1">
                <button type="submit"
                    class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition">Panggil Ulang</button>
            </form>

            <form method="POST" action="{{ route('riwayatantrians.reset') }}">
                @csrf
                <button type="submit"
                    class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition">Reset Antrian</button>
            </form>
        </div>

        {{-- Flash Message --}}
        @if (session('success'))
            <p class="text-green-600 font-semibold text-center">{{ session('success') }}</p>
        @endif

        {{-- Data Antrian yang Sedang Dipanggil --}}
        @if (isset($antrian))
            <div class="mt-6 bg-green-100 p-4 rounded-lg text-center">
                <h3 class="text-xl font-semibold">
                    Dipanggil: <span id="nama-antrian" class="text-green-800">{{ $antrian->no_antrian }}</span> -
                    Loket: <span id="loket-antrian" class="text-green-800">{{ $antrian->loket->nama_lokets }}</span>
                </h3>
            </div>

<script>
    window.speechSynthesis.onvoiceschanged = function () {
        const nama = document.getElementById("nama-antrian").innerText;
        const loket = document.getElementById("loket-antrian").innerText;
        const msg = new SpeechSynthesisUtterance(`Nomor antrian ${nama}, silakan menuju ${loket}`);
        msg.lang = "id-ID";
        msg.rate = 0.9;
        msg.pitch = 1.1;

        const voices = window.speechSynthesis.getVoices();
        const indoVoice = voices.find(voice => voice.lang === "id-ID") || voices.find(voice => voice.lang.includes("id"));
        if (indoVoice) {
            msg.voice = indoVoice;
        }

        window.speechSynthesis.speak(msg);
    };
</script>
        @endif

        <h2 class="text-2xl font-bold mt-10 mb-4">Daftar Antrian Belum Dipanggil</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
                <thead>
                    <tr class="bg-green-600 text-white text-left">
                        <th class="py-2 px-4">No</th>
                        <th class="py-2 px-4">No Antrian</th>
                        <th class="py-2 px-4">Loket</th>
                        <th class="py-2 px-4">Waktu Dibuat</th>
                        <th class="py-2 px-4">Dipanggil</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($antriansDipanggil ?? [] as $index => $antrian)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-2 px-4">{{ $index + 1 }}</td>
                            <td class="py-2 px-4">{{ $antrian->no_antrian }}</td>
                            <td class="py-2 px-4">{{ $antrian->loket->nama_lokets ?? '-' }}</td>
                            <td class="py-2 px-4">{{ \Carbon\Carbon::parse($antrian->created_at)->format('d-m-Y H:i') }}</td>
                            <td class="py-2 px-4">{{ $antrian->dipanggil }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 px-4 text-center text-gray-500">Tidak ada antrian yang belum dipanggil.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</body>

</html>
