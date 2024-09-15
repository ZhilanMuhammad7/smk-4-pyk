@extends('layouts.master')
@section('content')
<div class="col-12">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Mitra PKL</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mitra</th>
                            <th>Jumlah Kuota</th>
                            <th>Kriteria</th>
                            <th>Jurusan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tabel as $mitra)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $mitra->nama_mitra }}</td>
                            <td>
                                @if($mitra->jml_kuota > 0)
                                {{ $mitra->jml_kuota }}
                                @else
                                <span class="badge bg-danger">Kuota Habis</span>
                                @endif
                            </td>
                            <td>{{ $mitra->kriteria }}</td>
                            <td>{{ $mitra->jurusan }}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg-{{ $mitra->id }}" id="myLargeModalLabel"><i class="ti-eye"></i>Detail</button>
                                <div class="modal fade" id="bs-example-modal-lg-{{ $mitra->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Detail Mitra</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="box-body">
                                                    <div class="table-responsive">
                                                        <table id="example1" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Nama Mitra</th>
                                                                    <th>Jumlah Kuota</th>
                                                                    <th>Kriteria</th>
                                                                    <th>Jurusan</th>
                                                                    <th>Lokasi</th>
                                                                    <th>Fasilitas</th>
                                                                    <th>Tanggal Mulai</th>
                                                                    <th>Tanggal Selesai</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $mitra->nama_mitra }}</td>
                                                                    <td>{{ $mitra->jml_kuota }}</td>
                                                                    <td>{{ $mitra->kriteria }}</td>
                                                                    <td>{{ $mitra->jurusan }}</td>
                                                                    <td>{{ $mitra->lokasi }}</td>
                                                                    <td>{{ $mitra->fasilitas }}</td>
                                                                    <td>{{ $mitra->tgl_mulai }}</td>
                                                                    <td>{{ $mitra->tgl_selesai }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php
                                $pengajuan = \App\Models\Pengajuan::where('user_id', auth()->user()->id)->first();
                                $canApply = !$pengajuan || !in_array($pengajuan->status, ['Diterima', 'Diproses', 'Selesai']);
                                @endphp

                                @if($mitra->jml_kuota > 0 && $canApply)
                                <a href="{{ route('formPengajuanMitra', $mitra->id) }}" class="btn btn-success btn-sm mb-2">
                                    <i class="ti-pencil-alt"></i> Ajukan
                                </a>
                                @endif

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('assets/vendor_components/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
    function resetForm1() {
        $('#formAdd1')[0].reset();
    }

    function add_ajax1() {
        method = 'add';
        resetForm();
        $('#myModalLabel11').html("Tambah");
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#m_modal1').modal('show');
    }

    // Remove the save1 function
</script>

@endsection