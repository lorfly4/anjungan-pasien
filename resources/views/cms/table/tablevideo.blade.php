@extends('cms.layout.main')
@section('contentadmin')
    <div class="container mt-4">
        {{-- Header --}}
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambahkan Video</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="background-color:#f4f6f9;">
                    <li class="breadcrumb-item"><a href="#">Halaman Utama</a></li>
                    <li class="breadcrumb-item active">Tambahkan Video</li>
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
                            <td>{{ $video->id }}</td>
                            <td>{{ $video->title }}</td>
                            <td>{{ $video->type }}</td>
                            <td>
                                @if ($video->type == 'local')
                                    <video width="320" height="240" controls autoplay muted>
                                        <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                                        Browser Anda tidak mendukung video.
                                    </video>
                                @elseif($video->type == 'youtube')
                                    @php
                                        // Ubah URL menjadi embed dan tambahkan parameter autoplay=1
                                        $embedUrl = str_replace('watch?v=', 'embed/', $video->path);

                                        // Tambahkan tanda ? atau & tergantung apakah sudah ada query string
                                        $embedUrl .= (str_contains($embedUrl, '?') ? '&' : '?') . 'autoplay=1&mute=1';
                                    @endphp

                                    <iframe width="320" height="240" src="{{ $embedUrl }}" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                @else
                                    <p>Jenis video tidak dikenal</p>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('video.editvideo', $video->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('video.deletevideo', $video->id)}}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger"
                                        onclick="return Swal.fire({
                                            title: 'Yakin hapus?',
                                            text: 'Data video akan dihapus secara permanen!',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Ya, hapus!'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                return true;
                                            } else {
                                                return false;
                                            }
                                        })">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>



        {{-- Pagination --}}
        <div class="d-flex justify-content-end">
            {{ $videos->links('pagination::bootstrap-4') }}
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
