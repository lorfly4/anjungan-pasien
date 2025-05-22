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

        <table id="dataTable" class="table">
            <thead>
                <tr>
                    <th>name</th>
                    <th>email</th>
                    <th>created_at</th>
                </tr>
            </thead>
        </table>

        @push('scripts')
            <script>
                $(document).ready(function() {
                    $('#dataTable').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "{{ route('userserverside.index') }}",
                        columns: [{
                                data: 'name',
                                name: 'name'
                            },
                            {
                                data: 'email',
                                name: 'email'
                            },
                            {
                                data: 'created_at',
                                name: 'created_at'
                            }
                        ]
                    });
                });
            </script>
        @endpush
    @endsection
