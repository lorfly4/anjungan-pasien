@extends('cms.layout.main')

@section('contentadmin')
    <div class="container mt-4">
        {{-- Header --}}
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tabel Create User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="background-color:#f4f6f9;">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Tabel Create User</li>
                </ol>
            </div>
        </div>

        {{-- Tombol dan Search --}}
        <div class="d-flex justify-content-between mb-2">
            <a href="{{ route('createuser.showcreateuser') }}" class="btn btn-sm btn-success">Create</a>
            <form action="{{ route('createuser.index') }}" method="GET" class="d-flex">
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
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Loket</th>
                    <th>Role</th>
                    <th>Tanggal Daftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $user)
                    <tr class="text-center align-middle">
                        <td class="text-start py-5">{{ $users->firstItem() + $index }}</td>
                        <td>
                            <img src="{{ asset('storage/images/' . $user->image) }}" alt="Foto User"
                                style="width: 100px; height: 100px; object-fit: cover;">
                        </td>
                        <td class="text-start py-5">{{ $user->name }}</td>
                        <td class="text-start py-5">{{ $user->email }}</td>
                        <td class="text-start py-5">{{ $user->loket?->nama_lokets ?? '-' }}</td>
                        <td class="text-start py-5">{{ $user->role }}</td>
                        <td class="text-start py-5">{{ $user->created_at->format('d-m-Y') }}</td>
                        <td class="text-start py-5">
                            <a href="{{ route('createuser.edituser', [$user->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('createuser.deleteuser', [$user->id]) }}" method="POST" class="d-inline"
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
                        <td colspan="7" class="text-center">Tidak ada data pengguna.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="d-flex justify-content-end">
            {{ $users->onEachSide(1)->links('pagination::bootstrap-4') }}
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
