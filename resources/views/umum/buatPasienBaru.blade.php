<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pasien Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5">
        <a href="/umum" class="text-blue-600 hover:text-blue-800 flex items-center mr-4">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <h1 class="text-black font-extrabold text-[64px] leading-[72px] font-sans mb-20">
                    ANJUNGAN PASIEN MANDIRI
                </h1>
            </div>

            <div class="col-md-6">
                <form action="/umum/buatPasienBaru" method="POST" autocomplete="off">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="no_rm" class="form-control" id="no_rm" hidden>
                    </div>
                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap"
                            placeholder="Silahkan isi nama lengkap anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" name="nik" class="form-control" id="nik"
                            placeholder="Silahkan isi NIK anda (14 digit)" required maxlength="14" minlength="14"
                            pattern="^\d{14}$">
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                                <option value="">Pilih jenis kelamin</option>
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir"
                                placeholder="Silahkan isi tempat lahir anda" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control" id="alamat"
                                placeholder="Silahkan isi alamat lengkap anda" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No. HP</label>
                            <input type="text" name="no_hp" class="form-control" id="no_hp"
                                placeholder="Silahkan isi no hp anda" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Optional" id="email">
                        </div>
                        <div class="mb-3">
                            <label for="status_menikah" class="form-label">Status Menikah</label>
                            <select name="status_menikah" id="status_menikah" class="form-select" required>
                                <option value="">Pilih status menikah</option>
                                <option value="sudah">Menikah</option>
                                <option value="belum">Belum Menikah</option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-primary" id="previewBtn">Simpan</button>
                </form>

                <!-- Modal Preview -->
                <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="previewModalLabel">Preview Data Pasien</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <ul class="list-group">
                                    <li class="list-group-item"><strong>Nama Lengkap:</strong> <span
                                            id="preview_nama"></span></li>
                                    <li class="list-group-item"><strong>NIK:</strong> <span id="preview_nik"></span>
                                    </li>
                                    <li class="list-group-item"><strong>Jenis Kelamin:</strong> <span
                                            id="preview_jk"></span></li>
                                    <li class="list-group-item"><strong>Tempat Lahir:</strong> <span
                                            id="preview_tempat"></span></li>
                                    <li class="list-group-item"><strong>Tanggal Lahir:</strong> <span
                                            id="preview_tanggal"></span></li>
                                    <li class="list-group-item"><strong>Alamat:</strong> <span
                                            id="preview_alamat"></span></li>
                                    <li class="list-group-item"><strong>No. HP:</strong> <span id="preview_hp"></span>
                                    </li>
                                    <li class="list-group-item"><strong>Email:</strong> <span id="preview_email"></span>
                                    </li>
                                    <li class="list-group-item"><strong>Status Menikah:</strong> <span
                                            id="preview_status"></span></li>
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Edit</button>
                                <button type="button" class="btn btn-primary" id="submitFinal">Konfirmasi &
                                    Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
                <script>
                    document.getElementById('previewBtn').addEventListener('click', function () {
                        // Ambil data dari form
                        document.getElementById('preview_nama').textContent = document.getElementById('nama_lengkap').value;
                        document.getElementById('preview_nik').textContent = document.getElementById('nik').value;
                        document.getElementById('preview_jk').textContent = document.getElementById('jenis_kelamin').value;
                        document.getElementById('preview_tempat').textContent = document.getElementById('tempat_lahir').value;
                        document.getElementById('preview_tanggal').textContent = document.getElementById('tanggal_lahir').value;
                        document.getElementById('preview_alamat').textContent = document.getElementById('alamat').value;
                        document.getElementById('preview_hp').textContent = document.getElementById('no_hp').value;
                        document.getElementById('preview_email').textContent = document.getElementById('email').value;
                        document.getElementById('preview_status').textContent = document.getElementById('status_menikah').value;

                        // Tampilkan modal
                        var previewModal = new bootstrap.Modal(document.getElementById('previewModal'));
                        previewModal.show();
                    });

                    // Submit form saat konfirmasi
                    document.getElementById('submitFinal').addEventListener('click', function () {
                        document.querySelector('form').submit();
                    });
                </script>
            </div>
        </div>
    </div>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="module">
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif
</script>