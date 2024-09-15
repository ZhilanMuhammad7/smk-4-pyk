@extends('layouts.master')
@section('content')
<div class="col-12">
    <div class="box">
        <div class="box-header with-border" style="justify-content: space-between; display: flex;">
            <h3 class="box-title">List Mitra PKL</h3>
            <a href="{{ route('mitra.formMitra') }}" class="btn btn-primary">
                <i class="ti-plus"></i> Tambah Mitra PKL
            </a>
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
                            <th>Lokasi</th>
                            <th>Fasilitas</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tabel as $mitra)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $mitra->nama_mitra }}</td>
                            <td>{{ $mitra->jml_kuota }}</td>
                            <td>{{ $mitra->kriteria }}</td>
                            <td>{{ $mitra->jurusan }}</td>
                            <td>{{ $mitra->lokasi }}</td>
                            <td>{!! nl2br(e($mitra->fasilitas)) !!}</td>
                            <td>{{ $mitra->tgl_mulai }}</td>
                            <td>{{ $mitra->tgl_selesai }}</td>
                            <td>
                                <a href="{{ route('Guru.editMitra', $mitra->id) }}" class="btn btn-warning btn-sm mb-2">
                                    <i class="ti-pencil"></i> Edit
                                </a>
                                <a href="{{ route('Guru.deleteMitra', $mitra->id) }}" class="btn btn-danger btn-sm mb-2" onclick="return confirm('Apakah Anda yakin ingin menghapus mitra ini?')">
                                    <i class="ti-trash"></i> Hapus
                                </a>
                                <a href="{{ route('Guru.lihatPengajuan', $mitra->id) }}" class="btn btn-info btn-sm mb-2">
                                    <i class="ti-eye"></i> Lihat
                                </a>
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
@endsection