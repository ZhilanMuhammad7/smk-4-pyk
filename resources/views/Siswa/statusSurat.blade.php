@extends('layouts.master')
@section('content')
<div class="col-12">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Status Pengajuan Surat</h3>
        </div>
        <div class="box-body">
            @foreach($data as $row)
                @if($row->status == 'Diterima')
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>Notifikasi!</strong> Pengajuan surat Anda telah diterima, Silahkan ambil surat pkl Anda.
                    </div>
                @endif
                @if($row->status == 'Ditolak')
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>Notifikasi!</strong> Pengajuan surat Anda telah ditolak, Silahkan ulangi pengajuan surat Anda.
                    </div>
                @endif
                @if($row->status == 'Diproses')
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>Notifikasi!</strong> Pengajuan surat Anda sedang diproses, Silahkan tunggu sampai selesai.
                    </div>
                @endif
            @endforeach
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nama Tempat PKL</th>
                            <th>Status</th>
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
                            <td>{{ $row->tempat_pkl }}</td>
                            <td>
                                @if ($row->status == 'Diterima')
                                <button type="button" class="btn btn-success btn-sm">
                                    {{ $row->status }}
                                </button>
                                @elseif ($row->status == 'Ditolak')
                                <button type="button" class="btn btn-danger btn-sm">
                                    {{ $row->status }}
                                </button>
                                @elseif ($row->status == 'Diproses')
                                <button type="button" class="btn btn-warning btn-sm">
                                    {{ $row->status }}
                                </button>
                                @else
                                <button type="button" class="btn btn-secondary btn-sm">
                                    {{ $row->status }}
                                </button>
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
                <a class="btn btn-primary" href="{{route('layanan-akademik.index')}}">Kembali</a>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
</div>
@endsection