@extends('layouts.master')
@section('content')
<div class="col-12">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">List Data Pengajuan Surat PKL</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif
            @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Tanggal Mulai PKL</th>
                            <th>Tanggal Selesai PKL</th>
                            <th>No Handphone</th>
                            <th>Alamat Tinggal Saat Ini</th>
                            <th>Nama Tempat PKL</th>
                            <th>Bidang Kerja</th>
                            <th>Jurusan</th>
                            <th>Aksi</th>
                            <th>Download Surat</th>
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
                            <td>{{ $row->tempat_lahir }}</td>
                            <td>{{ $row->tgl_lahir }}</td>
                            <td>{{ $row->tgl_mulai_pkl }}</td>
                            <td>{{ $row->tgl_selesai_pkl }}</td>
                            <td>{{ $row->no_handphone }}</td>
                            <td>{{ $row->alamat }}</td>
                            <td>{{ $row->tempat_pkl }}</td>
                            <td>{{ $row->bidang_kerja }}</td>
                            <td>{{ $row->jurusan }}</td>
                            <td>
                                @if($row->status == 'Diterima')
                                <span class="badge bg-success">Diterima</span>
                                @elseif($row->status == 'Ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                                @else
                                <div>
                                    <a href="{{ route('layanan-akademik.aprovalSurat', ['id' => $row->id, 'status' => 'Diterima']) }}" class="btn btn-success btn-sm mb-2">
                                        Terima
                                    </a>
                                    <a href="{{ route('layanan-akademik.aprovalSurat', ['id' => $row->id, 'status' => 'Ditolak']) }}" class="btn btn-danger btn-sm">
                                        Tolak
                                    </a>
                                </div>
                                @endif
                            </td>
                            @if($row->status == 'Diterima')
                            <td>
                                <a href="{{ route('layanan-akademik.downloadSurat', ['id' => $row->id]) }}" class="btn btn-primary btn-sm">
                                    <i class="ti-download"></i>Download
                                </a>
                            </td>
                            @endif
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
@endsection