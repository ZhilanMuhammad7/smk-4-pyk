@extends('layouts.master')
@section('content')
<div class="col-12">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">List Data Pengajuan PKL</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jurusan</th>
                            <th>Nama Tempat PKL</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>konfirmasi Email</th>
                            <th>Aksi</th>
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
                            <td>
                                @if($row->status == 'Diterima')
                                <span class="badge bg-success">Diterima</span>
                                @elseif($row->status == 'Ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                                @else
                                <div>
                                    <a href="{{ route('data-pengajuan.approvalPKL', ['id' => $row->id, 'status' => 'Diterima']) }}" class="btn btn-success btn-sm">
                                        Terima
                                    </a>
                                    <a href="{{ route('data-pengajuan.approvalPKL', ['id' => $row->id, 'status' => 'Ditolak']) }}" class="btn btn-danger btn-sm">
                                        Tolak
                                    </a>
                                </div>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @if($data->isEmpty())
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
</div>
@endsection