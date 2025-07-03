@extends('cms.layout.main')
@section('contentadmin')
    <div class="container mt-4">
        {{-- Header --}}
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tabel Buat Poli</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="background-color:#f4f6f9;">
                    <li class="breadcrumb-item"><a href="#">Halaman Utama</a></li>
                    <li class="breadcrumb-item active">Tabel Buat Poli</li>
                </ol>
            </div>
        </div>

        {{-- Tombol dan Search --}}
        <div class="d-flex justify-content-between mb-2">
            <a href="{{ route('poli.showpoli') }}" class="btn btn-sm btn-success">Create</a>
            <form action="{{ route('poli.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari user..."
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
                    <th class="text-center" style="width: 3em;">No</th>
                    <th>Poli</th>
                    <th>Status OPC IPC</th>
                    <th>Status Poli</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($polis as $poli)
                    <tr>
                        <td class="text-center">{{ ($polis->currentPage() - 1) * $polis->perPage() + $loop->iteration }}
                        </td>
                        <td>{{ $poli->nama_poli }}</td>
                        <td>{{ $poli->status_opc_ipc }}</td>
                        <td class="text-center">
                            <span class="badge badge-{{ $poli->status == 1 ? 'success' : 'secondary' }}">
                                {{ $poli->status == 1 ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('poli.showeditpoli', $poli->id_poli) }}"
                                class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('poli.deletepoli', $poli->id_poli) }}" method="POST" class="d-inline"
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
                            <button type="button" class="btn btn-sm btn-{{ $poli->status == 'active' ? 'success' : 'secondary' }}"
                                data-toggle="modal" data-target="#modalStatus{{ $poli->id_poli }}">
                                {{ $poli->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modalStatus{{ $poli->id_poli }}" tabindex="-1" aria-labelledby="modalStatusLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalStatusLabel">Ubah Status</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('poli.updatestatuspoli', $poli->id_poli) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="status_poli">Status Poli</label>
                                                    <select name="status" id="status" class="form-control">
                                                        <option value="" disabled>Pilih Status Poli</option>
                                                        <option value="true" {{ $poli->status == 'active' ? 'selected' : '' }}>Aktif</option>
                                                        <option value="false" {{ $poli->status == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="3">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="d-flex justify-content-end">
            {{ $polis->onEachSide(1)->links('pagination::bootstrap-4') }}
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
