@extends('layouts.master')
@section('content')
<div class="box">
    <div class="box-header with-border">
        <h4 class="box-title">Layanan Akademik</h4>
    </div>
    <div class="box-body">
        <button type="button" class="btn btn-success" onclick="add_ajax()">Surat Pengajuan PKL</button>
        <a class="popup-with-form btn btn-info" href="{{route('status.statusSurat')}}">Lihat Status Pengajuan Surat PKL</a>
        <a class="popup-with-form btn btn-warning" href="{{route('statusPengajuanMitra')}}">Lihat Status Pengajuan Mitra PKL</a>
        <button type="button" class="btn btn-primary" onclick="showUlasanForm()">Penilaian dan Ulasan Tempat Kerja Praktik</button>

        <!-- @if($pengajuanSelesai)
        <button type="button" class="btn btn-primary" onclick="showUlasanForm()">Penilaian dan Ulasan Tempat Kerja Praktik</button>
        @endif -->
    </div>
</div>



<div class="modal fade text-left" id="ulasanModal" tabindex="-1" role="dialog" aria-labelledby="ulasanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ulasanModalLabel">Form Penilaian dan Ulasan Tempat Kerja Praktik</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form class="form" action="{{ route('penilaian.ulasan.submit') }}" method="POST" id="ulasanForm">
                                @csrf
                                <input type="hidden" name="id" id="pengajuan_id">
                                <input type="hidden" id="source" name="source">

                                <div class="form-group">
                                    <h5>Nama Tempat PKL</h5>
                                    <input type="text" name="tempat_magang" id="tempat_magang" class="form-control" readonly>
                                </div>

                                <div class="form-group">
                                    <h5>Jurusan</h5>
                                    <input type="text" name="jurusan" id="jurusan" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <h5>Ulasan <span class="text-danger">*</span></h5>
                                    <textarea name="ulasan" id="ulasan" class="form-control" required></textarea>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" form="ulasanForm" class="btn btn-success">Simpan</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade text-left" id="m_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Form Surat Pengajuan PKL</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form class="form" action="" method="POST" id="formAdd" enctype="multipart/form-data">
                                @csrf <!-- Tambahkan ini untuk mengatasi CSRF token mismatch -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <h5>Nama <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="name" class="form-control" required
                                                    data-validation-required-message="This field is required"
                                                    placeholder="Masukkan Nama"
                                                    value="{{ auth()->user()->name }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <h5>Tempat Lahir <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="tempat_lahir" class="form-control" required data-validation-required-message="This field is required" placeholder="Masukkan Tempat Lahir">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h5>Tanggal Lahir <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="date" name="tgl_lahir" class="form-control" required data-validation-required-message="This field is required">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h5>Tanggal Mulai PKL <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="date" name="tgl_mulai_pkl" class="form-control" required data-validation-required-message="This field is required">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h5>Tanggal Selesai PKL <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="date" name="tgl_selesai_pkl" class="form-control" required data-validation-required-message="This field is required">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h5>No Handphone <span class="text-danger">*</span></h5>
                                            <input type="number" name="no_handphone" class="form-control" required data-validation-required-message="This field is required" max="12" placeholder="Masukkan No Handphone">
                                            <div class="form-control-feedback">
                                                <small><i>Harus Kurang Dari 12 Angka</i></small>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h5>Alamat Tinggal Saat Ini <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <textarea name="alamat" id="textarea" class="form-control" required data-validation-required-message="This field is required" placeholder="Masukkan Alamat"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h5>Nama Tempat PKL <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="tempat_pkl" class="form-control" required data-validation-required-message="This field is required" placeholder="Masukkan Nama Tempat PKL">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h5>Bidang Kerja <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="bidang_kerja" class="form-control" required data-validation-required-message="This field is required" placeholder="Masukkan Bidang Kerja">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Jurusan <span class="text-danger">*</span></label>
                                            <select class="form-select" name="jurusan" required data-validation-required-message="This field is required">
                                                <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak (RPL)</option>
                                                <option value="Teknik Komputer Jaringan">Teknik Komputer Jaringan (TKJ)</option>
                                                <option value="Multimedia">Multimedia (MM)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" onclick="save()" id="btnSaveAjax" class="btn btn-success text-start">
                    Simpan
                </a>
                <button type="button" class="btn btn-danger text-start" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('assets/vendor_components/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
    // Fungsi untuk mereset form
    function resetForm() {
        $('#formAdd')[0].reset(); // Reset semua input dalam form
        $('.form-group').removeClass('has-error'); // Hilangkan class error pada form-group
        $('.help-block').empty(); // Kosongkan bantuan teks
    }

    // Fungsi untuk menambahkan data baru dengan AJAX
    function add_ajax() {
        method = 'add'; // Set metode menjadi 'add'
        resetForm(); // Reset form sebelum digunakan
        $('#myModalLabel1').html("Tambah Surat"); // Ubah judul modal
        $('#m_modal').modal('show'); // Tampilkan modal
    }

    // Fungsi untuk menyimpan data
    function save() {
        let url;

        // Tentukan URL berdasarkan metode
        if (method === 'add') {
            url = "{{ route('layanan-akademik.store') }}";
        } else {
            url = "{{ route('layanan-akademik.update') }}";
        }

        // Ambil data dari form dan tambahkan ke FormData
        var formData = new FormData($('#formAdd')[0]);
        formData.append('status', 'Diproses'); // Tambahkan status default
        formData.append('_token', '{{ csrf_token() }}'); // Tambahkan CSRF token

        // Kirim data dengan AJAX
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false, // Jangan proses data
            contentType: false, // Jangan tentukan tipe konten
            dataType: "json",
            success: function(data) {
                if (data.status) {
                    $('#m_modal').modal('hide'); // Sembunyikan modal jika sukses
                    Swal.fire({
                        title: 'Berhasil..',
                        text: 'Data Anda berhasil disimpan',
                        icon: 'success'
                    }).then(function() {
                        location.reload(); // Muat ulang halaman setelah berhasil
                    });
                } else {
                    Swal.fire({
                        text: data.message,
                        icon: 'warning'
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Swal.fire({
                    title: 'Oops',
                    text: 'Data gagal disimpan!',
                    icon: 'error'
                });
            }
        });
    }
</script>

<script type="text/javascript">
    function showUlasanForm() {
        $.ajax({
            url: "{{ route('penilaian.ulasan') }}",
            type: "GET",
            success: function(response) {
                if (response.status) {
                    var pengajuan = response.data.pengajuan;
                    var ajukanMitra = response.data.ajukan_mitra;

                    if (pengajuan) {
                        $('#pengajuan_id').val(pengajuan.id);
                        $('#tempat_magang').val(pengajuan.tempat_magang);
                        $('#jurusan').val(pengajuan.jurusan);
                        $('#ulasan').val(pengajuan.ulasan || '');
                        $('#source').val('pengajuan'); // Menyimpan sumber data
                    } else if (ajukanMitra) {
                        $('#pengajuan_id').val(ajukanMitra.id);
                        $('#tempat_magang').val(ajukanMitra.mitra ? ajukanMitra.mitra.nama_mitra : '');
                        $('#jurusan').val(ajukanMitra.jurusan);
                        $('#ulasan').val('');
                        $('#source').val('ajukan_mitra'); // Menyimpan sumber data
                    }

                    $('#ulasanModal').modal('show');
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message,
                        icon: 'error'
                    });
                }
            },
            error: function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Gagal memuat data ulasan.',
                    icon: 'error'
                });
            }
        });
    }

    $('#ulasanForm').on('submit', function(e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: "{{ route('penilaian.ulasan.submit') }}",
            type: "POST",
            data: formData,
            success: function(response) {
                if (response.status) {
                    $('#ulasanModal').modal('hide');
                    Swal.fire({
                        title: 'Berhasil',
                        text: 'Ulasan berhasil disimpan',
                        icon: 'success'
                    }).then(function() {
                        window.location.href = "{{ route('layanan-akademik.index') }}";
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message,
                        icon: 'error'
                    });
                }
            },
            error: function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat menyimpan ulasan',
                    icon: 'error'
                });
            }
        });
    });
</script>



@endsection