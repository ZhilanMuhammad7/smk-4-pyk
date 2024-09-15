@extends('layouts.master')
@section('content')
<div class="col-12">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">List Data Pengajuan Mitra PKL</h3>
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
                            <th>Transkrip Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = 1;
                        @endphp
                        @foreach($mitra as $row)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $row->nama }}</td>
                            <td>{{ $row->jurusan }}</td>
                            <td>
                                <img src="{{ Storage::url($row->gambar) }}" alt="Transkrip Nilai" width="50" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#viewImage">
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
                                @if($row->status == 'diterima')
                                    <span class="badge bg-success">Diterima</span>
                                @elseif($row->status == 'ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                @else
                                    <a href="{{ route('Guru.konfirmasi', ['id' => $row->id]) }}" class="btn btn-success btn-sm">
                                        Terima
                                    </a>
                                    <a href="{{ route('Guru.tolak', ['id' => $row->id]) }}" class="btn btn-danger btn-sm">
                                        Tolak
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @if($mitra->isEmpty())
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <a href="{{ route('Guru.mitraPKL') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
</div>
@endsection