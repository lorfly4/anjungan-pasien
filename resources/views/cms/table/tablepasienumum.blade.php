@extends('cms.layout.main')
@section('contentadmin')
    <div class="container mt-4">
        {{-- Header --}}
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tabel Buat Pasien Umum</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="background-color:#f4f6f9;">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Tabel Buat Pasien Umum</li>
                </ol>
            </div>
        </div>

        {{-- Tombol dan Search --}}
        <div class="d-flex justify-content-between mb-2">
            <a href="{{ route('pasienumum.showcreatepasienumum')}}" class="btn btn-sm btn-success">Create</a>
            <form action="{{ route('poli.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari pasien..."
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
                <tr class="text-start py-5 align-middle">
                    <th class="text-center" style="width: 3em;">No</th>
                    <th class="text-center">Nomor Rekam Medik</th>
                    <th class="text-center">Nama Pasien</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pasienumum as $index => $patient)
                    <tr class="text-center align-middle">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $patient->no_rm }}</td>
                        <td>{{ $patient->nama_lengkap }}</td>
                        <td>{{ $patient->status_aktif }}</td>
                            <!-- Add action buttons or links here -->
                        <td class="text-center">
                            <a href="{{route('pasienumum.showeditpasienumum', $patient->id_pasien)}}"
                                class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{route('pasienumum.deletepasienumum', $patient->id_pasien)}}" method="POST" class="d-inline"
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
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                data-target="#detailModal{{ $patient->id }}">
                                Detail
                            </button>
                            <div class="modal fade" id="detailModal{{ $patient->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="detailModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailModalLabel">Detail Data Pasien</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-sm">
                                                <tr>
                                                    <th>Nomor Rekam Medis</th>
                                                    <td>{{ $patient->no_rm }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Nama Lengkap</th>
                                                    <td>{{ $patient->nama_lengkap }}</td>
                                                </tr>
                                                <tr>
                                                    <th>NIK</th>
                                                    <td>{{ $patient->nik }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Jenis Kelamin</th>
                                                    <td>{{ $patient->jenis_kelamin }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Alamat</th>
                                                    <td>{{ $patient->alamat }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Telepon</th>
                                                    <td>{{ $patient->no_hp }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tempat Lahir</th>
                                                    <td>{{ $patient->tempat_lahir }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tanggal Lahir</th>
                                                    <td>{{ \Carbon\Carbon::parse($patient->tanggal_lahir)->format('d/m/Y') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Email</th>
                                                    <td>{{ $patient->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    <td>{{ $patient->status_aktif }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="d-flex justify-content-end">
            {{-- {{ $polis->onEachSide(1)->links('pagination::bootstrap-4') }} --}}
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
