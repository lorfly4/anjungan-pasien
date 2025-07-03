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
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Tambahkan Video</li>
                </ol>
            </div>
        </div>

        <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Judul Video</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="videoType">Jenis Video</label>
                <select class="form-control" id="videoType" name="type" onchange="toggleInput()" required>
                    <option value="local">Upload Lokal</option>
                    <option value="youtube">Link YouTube</option>
                </select>
            </div>
            <div id="localUpload" class="form-group">
                <label for="video">File Video</label>
                <input type="file" class="form-control-file" id="video" name="video" accept="video/*">
            </div>
            <div id="youtubeInput" class="form-group" style="display: none;">
                <label for="youtube_link">Link YouTube</label>
                <input type="url" class="form-control" id="youtube_link" name="youtube_link">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>

        <script>
            function toggleInput() {
                let type = document.getElementById('videoType').value;
                document.getElementById('localUpload').style.display = type === 'local' ? 'block' : 'none';
                document.getElementById('youtubeInput').style.display = type === 'youtube' ? 'block' : 'none';
            }
        </script>

    </div>
@endsection()
