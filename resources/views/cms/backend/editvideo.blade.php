@extends('cms.layout.main')
@section('contentadmin')
    <div class="container mt-4">
        {{-- Header --}}
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Ubah Video</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="background-color:#f4f6f9;">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Ubah Video</li>
                </ol>
            </div>
        </div>

        <form action="{{ route('video.update', $video->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Judul Video</label>
                <input type="text" value="{{ $video->title ?? '' }}" class="form-control" id="title" name="title"
                    required>
            </div>
            <div class="form-group">
                <label for="videoType">Jenis Video</label>
                <select class="form-control" id="videoType" name="type" onchange="toggleInput()" required>
                    <option value="local" {{ old('type', $video->type) === 'local' ? 'selected' : '' }}>Upload Lokal
                    </option>
                    <option value="youtube" {{ old('type', $video->type) === 'youtube' ? 'selected' : '' }}>Link YouTube
                    </option>
                </select>
            </div>
            <div id="localUpload" class="form-group"
                style="display: {{ old('type', $video->type) !== 'youtube' ? 'block' : 'none' }}">
                <label for="video">File Video</label>
                <input type="file" class="form-control-file" id="video" name="video" accept="video/*">
                @if (old('type', $video->type) !== 'youtube' && $video->path !== url($video->path))
                    <p class="text-muted">Current file: {{ $video->path }}</p>
                @endif
            </div>
            <div id="youtubeInput" class="form-group"
                style="display: {{ old('type', $video->type) === 'youtube' ? 'block' : 'none' }}">
                <label for="youtube_link">Link YouTube</label>
                <input type="url" value="{{ old('youtube_link', $video->path ?? '') }}" class="form-control"
                    id="youtube_link" name="youtube_link">
                @if (old('type', $video->type) === 'youtube' && $video->path === url($video->path))
                    <p class="text-muted">Current URL: {{ $video->path }}</p>
                @endif
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

        </form>

    </div>
@endsection()
