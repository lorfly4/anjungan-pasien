<!DOCTYPE html>
<html>
<head>
    <title>Panggil Antrian</title>
    <!-- Bootstrap 4 CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- SweetAlert2 CDN (untuk alert yang lebih menarik) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { background: #f4f6f9; }
        .card { box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        .btn { min-width: 120px; }
        .table thead th { background: #007bff; color: #fff; }
        .swal2-popup { font-size: 1.1rem; }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Panggilan Antrian</h3>
                </div>
                <div class="card-body">

                    <div class="mb-3 d-flex flex-wrap gap-2">
                        <form action="{{ route('plasma.panggil') }}" method="POST" class="mr-2">
                            @csrf
                            <button type="submit" class="btn btn-success">Panggil Baru</button>
                        </form>
                        <form action="{{ route('plasma.panggil') }}" method="POST" class="mr-2">
                            @csrf
                            <input type="hidden" name="ulang" value="1">
                            <button type="submit" class="btn btn-warning">Panggil Ulang</button>
                        </form>
                        <form method="POST" action="{{ route('plasma.reset') }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">Reset Antrian</button>
                        </form>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    @endif

                    @if (isset($antrian))
                        <div class="alert alert-info text-center">
                            <h4 class="mb-1">Dipanggil: <span id="nama-antrian" class="font-weight-bold">{{ $antrian->no_antrian }}</span></h4>
                            <h5>Loket: <span id="loket-antrian" class="font-weight-bold">{{ $antrian->loket->nama_lokets }}</span></h5>
                        </div>
                        <script>
                            // Fungsi Text-to-Speech
                            const loket = document.getElementById("loket-antrian").innerText;
                            const nama = document.getElementById("nama-antrian").innerText;
                            const msg = new SpeechSynthesisUtterance(`Nomor antrian ${nama}, silakan menuju ${loket}`);
                            msg.lang = "id-ID";
                            msg.rate = 0.8;
                            msg.pitch = 1;
                            window.speechSynthesis.speak(msg);
                        </script>
                    @endif

                    <h5 class="mt-4 mb-3">Daftar Antrian Belum Dipanggil</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="text-center align-middle">
                                    <th>No</th>
                                    <th>No Antrian</th>
                                    <th>Loket</th>
                                    <th>Waktu Dibuat</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
<tbody>
    @php $no = 1; @endphp
    @forelse($antriansDipanggil ?? [] as $antrian)
        @if($antrian->dipanggil == 0)
            <tr class="text-center">
                <td>{{ $no++ }}</td>
                <td class="font-weight-bold">{{ $antrian->no_antrian }}</td>
                <td>{{ $antrian->loket->nama_lokets ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($antrian->created_at)->format('d-m-Y H:i') }}</td>
                <td>
                    <span class="badge badge-secondary">Belum</span>
                </td>
            </tr>
        @endif
    @empty
        <tr>
            <td colspan="5" class="text-center">Tidak ada antrian yang belum dipanggil.</td>
        </tr>
    @endforelse
</tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS & dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>