@extends('cms.layout.main')
@section('contentadmin')
    <div class="container mt-4">
        {{-- Header --}}
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Dokter</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="background-color:#f4f6f9;">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Edit Dokter</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Dokter</h3>
                    </div>
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="id_dokter" value="{{ $dokter->id_dokter }}">
                                <form action="{{ route('tablecreatedokter.proseseditdokter', $dokter->id_dokter) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="foto">Foto</label>
                                        <input type="file" class="form-control" name="foto" id="foto" aria-describedby="foto" onchange="previewImage(event)">
                                        <div class="form-group mb-3" style="border: 2px solid #ccc; border-radius: 8px; padding: 8px; margin-top: 10px; width: 160px; height: 160px; display: flex; align-items: center; justify-content: center;">
                                            <img id="image-preview" src="{{ asset('storage/images/' . $dokter->foto_dokter) }}"
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
                                    <div class="form-group">
                                        <label for="name">Nama Dokter</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            aria-describedby="name" value="{{ $dokter->nama_dokter }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="poli_id">Poli</label>
                                        <select name="poli_id" id="poli_id" class="form-control">
                                            <option disabled>Pilih Poli</option>
                                            @foreach ($poli as $item)
                                                <option value="{{ $item->id_poli }}"
                                                    {{ $item->id_poli == $dokter->id_poli ? 'selected' : '' }}>
                                                    {{ $item->nama_poli }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary"
                                        onclick="showSweetAlert()">Submit</button>
                                    <script>
                                        function showSweetAlert() {
                                            Swal.fire({
                                                title: 'Success!',
                                                text: 'Your changes have been saved.',
                                                icon: 'success',
                                                confirmButtonText: 'OK'
                                            });
                                        }
                                    </script>
                                </form>
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
