@extends('cms.layout.main')
@section('contentadmin')
    <div class="container mt-4">
        {{-- Header --}}
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tabel Riwayat Antrian</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="background-color:#f4f6f9;">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Tabel Riwayat Antrian</li>
                </ol>
            </div>
        </div>

        {{-- Search --}}
        <div class="d-flex justify-content-between mb-2">
            <form action="#" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari pasien/poli..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-sm btn-primary ml-2">Cari</button>
            </form>
        </div>

        {{-- Flash message --}}
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            <script>
                setTimeout(function() {
                    document.querySelector('.alert').remove();
                }, 3000);
            </script>
        @endif

        {{-- Tabel --}}
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr class="text-center align-middle">
                    <th>No</th>
                    <th>Nomor Rekam Medis Pasien</th>
                    <th>No Antrian</th>
                    <th>Tanggal Antrian</th>
                    <th>Loket</th>
                    <th>Nama Pasien</th>
                    <th>Waktu Kunjungan</th>
                    <th>Dokter</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($riwayatantrian as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}
                        </td>
                        <td>{{ $item->no_rm ?? '-' }}</td>
                        <td>{{ $item->no_antrian ?? '-' }}</td>
                        <td>{{ $item->tanggal_antrian ?? '-' }}</td>
                        <td>{{ $item->loket->nama_lokets ?? '-' }}</td>                        <td>{{ $item->nama_pasien ?? '-' }}</td>
                        <td>{{ $item->jam ?? '-' }}</td>
                        <td>{{ $item->dokter ?? '-' }}</td>
                        {{-- <td>
                            <a href="#" class="btn btn-sm btn-info">Detail</a>
                        </td> --}}
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="6">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="d-flex justify-content-end">
            {{-- {{ $riwayatantrian->links('pagination::bootstrap-4') }} --}}
        </div>
    </div>
@endsection
