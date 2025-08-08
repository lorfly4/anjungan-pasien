@extends('cms.layout.main')
@section('contentadmin')
    <div class="container mt-4">
        {{-- Header --}}
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tabel Logo RS</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="background-color:#f4f6f9;">
                    <li class="breadcrumb-item"><a href="#">Halaman Utama</a></li>
                    <li class="breadcrumb-item active">Tabel Logo RS</li>
                </ol>
            </div>
        </div>

        {{-- Tombol dan Search --}}
        <div class="d-flex justify-content-between mb-2">
            <a href="{{ route('rs.create') }}" class="btn btn-sm btn-success">Create</a>
            <form action="{{ route('rs.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari RS..."
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
                setTimeout(function () {
                    document.querySelector('.alert').remove();
                }, 3000);
            </script>
        @endif

        {{-- Tabel --}}
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr class="text-center align-middle">
                    <th class="text-center" style="width: 3em;">No</th>
                    <th>Nama RS</th>
                    <th>Logo</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tampilan_rs as $rs)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $rs->nama_rs }}</td>
                        <td class="text-center">
                            @if ($rs->image)
                                <img src="{{ asset('img/' . $rs->image) }}" alt="{{ $rs->nama_rs }}" class="img-thumbnail"
                                    style="width: 100px; height: 100px;">
                            @else
                                <p class="text-center">Tidak ada logo</p>
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $rs->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($rs->status) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                <form action="{{ route('logos.updateStatus', $rs->id_rs) }}" method="POST" class="mr-2">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm {{ $rs->status == 'active' ? 'btn-danger' : 'btn-success' }}">
                                        {{ $rs->status == 'active' ? 'Non-aktifkan' : 'Aktifkan' }}
                                    </button>
                                </form>
                                <a href="{{ route('rs.edit', $rs->id_rs) }}" class="btn btn-sm btn-warning mr-2">Edit</a>
                                <form action="{{ route('rs.destroy', $rs->id_rs) }}" method="POST" onsubmit="return confirmSweetAlert(event, this)">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </div>
                            <script>
                                function confirmSweetAlert(event, form) {
                                    event.preventDefault();
                                    Swal.fire({
                                        title: 'Apakah Anda yakin?',
                                        text: "Data RS ini akan dihapus secara permanen!",
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
                        <td class="text-center" colspan="4">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

@endsection