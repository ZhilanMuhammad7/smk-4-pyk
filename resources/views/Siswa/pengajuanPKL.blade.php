@extends('layouts.master')
@section('content')
<div class="col-12">
    <div class="box">
        <div class="box-header with-border" style="justify-content: space-between; display: flex;">
            <h3 class="box-title">Pengajuan PKL</h3>
            @php
            $pengajuan = $data->first(); // Mengambil pengajuan pertama user
            @endphp
            @if(!$mitraDiterima && ($pengajuan == null || $pengajuan->status == 'Ditolak'))
            <button type="button" class="btn btn-info" onclick="add_ajax()">
                <i class="ti-plus"></i> Tambah Pengajuan PKL
            </button>
            @endif
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jurusan</th>
                            <th>Nama Tempat PKL</th>
                            <th>Tanggal Mulai PKL</th>
                            <th>Tanggal Selesai PKL</th>
                            <th>Bukti Email</th>
                            <th>Status</th>
                            <th>Aksi</th> <!-- Kolom aksi -->
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = 1;
                        @endphp
                        @foreach($data as $row)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->jurusan }}</td>
                            <td>{{ $row->tempat_magang }}</td>
                            <td>{{ $row->tgl_mulai }}</td>
                            <td>{{ $row->tgl_selesai }}</td>
                            <td>
                                <img src="{{ Storage::url($row->gambar) }}" alt="product" width="50" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#viewImage">
                                <div class="modal fade" id="viewImage" tabindex="-1" aria-labelledby="viewImageModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewImageModalLabel">Gambar</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{ Storage::url($row->gambar) }}" alt="" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $row->status }}</td>
                            <td>
                                @php
                                $today = \Carbon\Carbon::today();
                                $tglSelesai = \Carbon\Carbon::parse($row->tgl_selesai);
                                // Memastikan tombol hanya muncul jika tanggal selesai sudah lewat dan status bukan 'Selesai'
                                $canShowButton = $tglSelesai->lt($today) && $row->status !== 'Selesai';
                                @endphp
                                @if($canShowButton)
                                <button class="btn btn-success" onclick="updateStatus({{ $row->id }})">Selesai</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @if($data->isEmpty())
                        <tr>
                            <td colspan="14" class="text-center">Tidak ada data</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal and other scripts remain unchanged -->

<script type="text/javascript">
    function updateStatus(id) {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin mengubah status pengajuan ini menjadi selesai?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, selesai!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('pengajuan.updateStatus') }}",
                    type: "POST",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire('Sukses!', 'Status berhasil diubah.', 'success').then(function() {
                            location.reload();
                        });
                    },
                    error: function() {
                        Swal.fire('Gagal!', 'Gagal mengubah status.', 'error');
                    }
                });
            }
        });
    }
</script>
</div>

<div class="modal fade text-left" id="m_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Form Pengajuan PKL</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form class="form" action="" method="POST" id="formAdd" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="">
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <h5>Nama Lengkap <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h5>Jurusan <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="jurusan" class="form-control" value="{{ auth()->user()->jurusan }}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h5>Nama Tempat PKL <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="tempat_magang" class="form-control" required data-validation-required-message="This field is required" placeholder="Nama Tempat Magang">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h5>Tanggal Mulai PKL <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="date" name="tgl_mulai" class="form-control" required data-validation-required-message="This field is required" placeholder="Tanggal Mulai">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h5>Tanggal Selesai PKL <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="date" name="tgl_selesai" class="form-control" required data-validation-required-message="This field is required" placeholder="Tanggal Selesai">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h5>Bukti Email <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="file" name="gambar" class="form-control" required>
                                            </div>
                                            <div class="form-control-feedback"><small>Upload dalam bentuk jpg,png,jpeg <code>max 1MB</code> per file</small></div>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('assets/vendor_components/ckeditor/ckeditor.js')}}"></script>

<script type="text/javascript">
    function resetForm() {
        $('#formAdd')[0].reset();
    }

    function add_ajax() {
        method = 'add';
        resetForm();
        $('#myModalLabel1').html("Tambah Pengajuan");
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#m_modal').modal('show');
    }

    function save() {
        let url;

        if (method === 'add') {
            url = "{{ route('pengajuan.store') }}";
        } else {
            url = "{{ route('pengajuan.update') }}";
        }

        var formData = new FormData();
        formData.append('id', $('[name="id"]').val());
        formData.append('user_id', $('[name="user_id"]').val());
        formData.append('name', $('[name="name"]').val());
        formData.append('jurusan', $('[name="jurusan"]').val());
        formData.append('tempat_magang', $('[name="tempat_magang"]').val());
        formData.append('tgl_mulai', $('[name="tgl_mulai"]').val());
        formData.append('tgl_selesai', $('[name="tgl_selesai"]').val());
        formData.append('gambar', $('[name="gambar"]')[0].files[0]);
        formData.append('status', 'Diproses');
        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(data) {
                if (data.status) {
                    $('#m_modal').modal('hide');
                    Swal.fire({
                        title: 'Berhasil..',
                        text: 'Data Anda berhasil disimpan',
                        icon: 'success'
                    }).then(function() {
                        location.reload();
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

    // Cek apakah user sudah diterima
    @if($mitraDiterima)
    Swal.fire({
        title: 'Pemberitahuan',
        text: 'Anda sudah diterima di mitra yang tersedia, sehingga tidak dapat mengajukan kembali.',
        icon: 'info',
    });
    @endif
</script>
@endsection