@extends('cms.layout.main')
@section('contentadmin')

    <div class="container mt-4">
        {{-- Header --}}
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tabel Create Loket</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="background-color:#f4f6f9;">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Tabel Create Loket</li>
                </ol>
            </div>
        </div>

        {{-- Tombol dan Search --}}
        <div class="d-flex justify-content-between mb-2">
            <a href="{{ route('loket.showcreateloket')}}" class="btn btn-sm btn-success">Create</a>
            <form action="{{ route('loket.index')}}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari loket..."
                    value="{{ request('search')}}">
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
                    <th class="text-center" style="width: 3em;">No</th>
                    <th>Nama Loket</th>
                    <th>Jenis Berobat</th>
                    <th>Keterangan</th>
                    <th>Dokter</th>
                    <th>Poli</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($lokets as $loket)
                    <tr>
                        <td class="text-center">{{ ($lokets->currentPage() - 1) * $lokets->perPage() + $loop->iteration }}
                        </td>
                        <td>{{ $loket->nama_lokets }}</td>
                        <td>{{ $loket->jenis_berobat}}</td>
                        <td>{{ $loket->keterangan }}</td>
                        <td>{{ $loket->dokter->nama_dokter ?? '-' }}</td>
                        <td>{{ $loket->poli->nama_poli ?? '-' }} ({{ $loket->poli->status_opc_ipc}})</td>
                        <td>{{ $loket->kategori->kategoris ?? '-' }}</td>
                        <td>{{ $loket->status}}</td>
                        <td class="text-center">
                            <a href="{{ route('loket.showeditloket', $loket->id_lokets) }}"
                                class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('loket.prosesdeleteloket', $loket->id_lokets) }}" method="POST" class="d-inline"
                                onsubmit="return confirmSweetAlert(event, this)">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                            <script>
                                function confirmSweetAlert(event, form) {
                                    event.preventDefault();
                                    Swal.fire({
                                        title: 'Apakah Anda yakin?',
                                        text: "Data pengguna ini akan dihapus secara permanen!",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Ya, hapus!'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            form.submit();
                                        }
                                    })
                                }
                            </script>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="9">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="d-flex justify-content-end">
            {{ $lokets->onEachSide(1)->links('pagination::bootstrap-4') }}
        </div>

    </div>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "paging": false, // disable paging karena sudah pakai Laravel pagination
                "info": false,
                "searching": false // disable search bawaan datatables, karena pakai search Laravel
            });
        });
    </script>


@endsection