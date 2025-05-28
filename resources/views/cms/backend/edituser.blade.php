@extends('cms.layout.main')
@section('contentadmin')
    <div class="container-fluid mt-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit User</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="background-color:#f4f6f9;">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Edit User</li>

                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit User</h3>
                    </div>
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('createuser.updateuser', $users->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <label for="foto">Foto</label>
                                    <div class="form-group">
                                        <input type="file" class="form-control" name="foto" id="foto"
                                            aria-describedby="foto" onchange="previewImage(event)"
                                            value="{{ $users->image }}">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <div class="form-group mb-3"
                                                style="border: 2px solid #ccc; border-radius: 8px; padding: 8px; margin-top: 10px; width: 160px; height: 160px; display: flex; align-items: center; justify-content: center;">
                                                <img id="image-preview" src="{{ asset('storage/images/' . $users->image) }}"
                                                    alt="Preview"
                                                    style="width: 100%; height: 100%; object-fit: cover; border-radius: 4px;">
                                            </div>
                                            <script>
                                                function previewImage(event) {
                                                    var reader = new FileReader();
                                                    reader.onload = function() {
                                                        var output = document.getElementById('image-preview');
                                                        output.src = reader.result;
                                                    };
                                                    reader.readAsDataURL(event.target.files[0]);
                                                }
                                            </script>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            aria-describedby="name" value="{{ $users->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            aria-describedby="email" value="{{ $users->email }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="role">Loket</label>
                                        <select name="id_loket" id="id_loket"
                                            class="form-control @error('role') is-invalid @enderror">
                                            <option disabled selected>Pilih...</option>
                                            @foreach ($lokets as $item)
                                                <option value="{{ $item->id_lokets }}"
                                                    {{ old('id_loket', $users->id_lokets) == $item->id_lokets ? 'selected' : '' }}>
                                                    {{ $item->nama_lokets }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>



                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select name="role" id="role"
                                            class="form-control @error('role') is-invalid @enderror">
                                            <option disabled selected>Pilih...</option>
                                            <option value="admin"
                                                {{ old('role', $users->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="user"
                                                {{ old('role', $users->role) == 'user' ? 'selected' : '' }}>User</option>
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password <small>(Kosongkan jika tidak ingin
                                                mengubah)</small></label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary"
                                        onclick="showSweetAlert()">Submit</button>
                                </form>
                                <script>
                                    function showSweetAlert() {
                                        Swal.fire({
                                            title: 'Success!',
                                            text: 'Your changes have been saved.',
                                            icon: 'success',
                                            confirmButtonText: 'OK'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.href = "{{ route('createuser.index') }}";
                                            }
                                        });
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    </div>
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    <!-- /.content -->
@endsection
