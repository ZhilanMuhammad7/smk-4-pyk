@extends('layouts.master')
@section('content')
<div class="col-12">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Status Pengajuan Mitra PKL</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nama Mitra</th>
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
                            <td>{{ $row->nama }}</td>
                            <td>{{ $row->mitra->nama_mitra }}</td>
                            <td>{{ $row->status }}</td>
                        </tr>
                        @endforeach
                        @if($data->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data</td>
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