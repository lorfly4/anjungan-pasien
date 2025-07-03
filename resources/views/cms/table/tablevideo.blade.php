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


        <div class="d-flex justify-content-between mb-2">
            <a href="{{ route('video.create') }}" class="btn btn-sm btn-success">Tambahkan Video</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Video</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($videos as $video)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $video->title }}</td>
                            <td>{{ $video->type }}</td>
                            <td>
                                @foreach ($videos as $video)
                                    <div style="margin-bottom: 20px;">
                                        <strong>{{ $video->title }}</strong> <br>
                                        @if ($video->type == 'local')
                                            <video width="320" height="240" controls>
                                                <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                                                Browser Anda tidak mendukung video.
                                            </video>
                                        @else
                                            @php
                                                $embedUrl = str_replace('watch?v=', 'embed/', $video->path);
                                            @endphp

                                            <iframe width="320" height="240" src="{{ $embedUrl }}" frameborder="0"
                                                allowfullscreen>
                                            </iframe>
                                        @endif
                                    </div>
                                @endforeach
                            </td>

                            <td>
                                <a href="#" class="btn btn-sm btn-primary">Edit</a>
                                <form action="#" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>



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
