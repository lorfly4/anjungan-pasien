<!DOCTYPE html>
<html>

<head>
    <title>Panggil Antrian</title>
</head>

<body>

    <h1>Panggilan Antrian</h1>

    <form action="{{ route('riwayatantrians.panggil') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Panggil Baru</button>
    </form>

    <form action="{{ route('riwayatantrians.panggil') }}" method="POST">
        @csrf
        <input type="hidden" name="ulang" value="1">
        <button type="submit" class="btn btn-warning">Panggil Ulang</button>
    </form>


    {{-- Tombol Reset --}}
    <form method="POST" action="{{ route('riwayatantrians.reset') }}" style="margin-top: 10px;">
        @csrf
        <button type="submit">Reset Antrian</button>
    </form>

    {{-- Pesan Flash --}}
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
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
    @endif

    <h2>Daftar Antrian Belum Dipanggil</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>No Antrian</th>
                <th>Loket</th>
                <th>Waktu Dibuat</th>
                <th>Dipanggil</th>
            </tr>
        </thead>
        <tbody>
            @forelse($antriansDipanggil ?? [] as $index => $antrian)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $antrian->no_antrian }}</td>
                    <td>{{ $antrian->loket->nama_lokets ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($antrian->created_at)->format('d-m-Y H:i') }}</td>
                    <td>{{ $antrian->dipanggil }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Tidak ada antrian yang belum dipanggil.</td>
                </tr>
            @endforelse
        </tbody>
    </table>


</body>

</html>
