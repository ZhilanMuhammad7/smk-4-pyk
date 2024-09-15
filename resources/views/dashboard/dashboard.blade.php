@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-xl-8 col-12">
        <div class="box bg-primary-light">
            <div class="box-body d-flex px-0">
                <div class="flex-grow-1 p-30 flex-grow-1 bg-img dask-bg bg-none-md" style="background-position: right bottom; background-size: auto 100%; background-image: url(../images/svg-icon/color-svg/custom-1.svg)">
                    <div class="row">
                        <div class="col-12 col-xl-10">
                            @if(auth()->user()->role == 'siswa')
                            <h2>Selamat Datang, <strong>{{$data->name}}</strong></h2>
                            @endif

                            @if(auth()->user()->role == 'guru')
                            <h2>Kamu Masuk Sebagai Guru, <strong>{{$data->name}}</strong></h2>
                            @endif
                        </div>
                        <div class="col-12 col-xl-5"></div>
                    </div>
                </div>
            </div>
        </div>
        @if(auth()->user()->role == 'siswa')
        <div class="box bg-transparent no-shadow mb-0">
            <div class="box-header no-border">
                <h4 class="box-title">Data Pengajuan PKL</h4>
                <div class="box-controls pull-right d-md-flex d-none">
                    <a href="{{route('pengajuan.index')}}">View All</a>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="box-body py-0">
                <div class="table-responsive">
                    <table class="table no-border mb-0">
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @foreach($data_pkl->take(5) as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td class="fw-600">{{ $row->tempat_magang }}</td>
                                <td class="fw-500"><span class="badge badge-sm badge-dot badge-warning me-10"></span>{{ $row->tgl_mulai }}</td>
                                <td class="fw-500"><span class="badge badge-sm badge-dot badge-warning me-10"></span>{{ $row->tgl_selesai }}</td>
                                <td class="fw-600">{{ $row->status }}</td>
                            </tr>
                            @endforeach
                            @if($data_pkl->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

        @if(auth()->user()->role == 'guru')
        <div class="box bg-transparent no-shadow mb-0">
            <div class="box-header no-border">
                <h4 class="box-title">Data Surat</h4>
                <div class="box-controls pull-right d-md-flex d-none">
                    <a href="{{route('layanan-akademik.konfirmSurat')}}">View All</a>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="box-body py-0">
                <div class="table-responsive">
                    <table class="table no-border mb-0">
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @foreach($data_surat->take(5) as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td class="fw-600">{{ $row->name }}</td>
                                <td class="fw-500"><span class="badge badge-sm badge-dot badge-warning me-10"></span>{{ $row->tgl_mulai_pkl }}</td>
                                <td class="fw-500"><span class="badge badge-sm badge-dot badge-warning me-10"></span>{{ $row->tgl_selesai_pkl }}</td>
                                <td class="fw-500"><span class="badge badge-sm badge-dot badge-warning me-10"></span>{{ $row->tempat_pkl }}</td>
                                <td class="fw-500"><span class="badge badge-sm badge-dot badge-warning me-10"></span>{{ $row->bidang_kerja }}</td>
                                <td class="fw-600">{{ $row->status }}</td>
                            </tr>
                            @endforeach
                            @if($data_surat->isEmpty())
                            <tr>
                                <td colspan="14" class="text-center">Tidak ada data</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="box bg-transparent no-shadow mb-0">
            <div class="box-header no-border">
                <h4 class="box-title">Data Pengajuan PKL</h4>
                <div class="box-controls pull-right d-md-flex d-none">
                    <a href="{{route('data-pengajuan.index')}}">View All</a>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="box-body py-0">
                <div class="table-responsive">
                    <table class="table no-border mb-0">
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @foreach($data_pengajuan->take(5) as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td class="fw-600">{{ $row->name }}</td>
                                <td class="fw-600">{{ $row->tempat_magang }}</td>
                                <td class="fw-500"><span class="badge badge-sm badge-dot badge-warning me-10"></span>{{ $row->tgl_mulai }}</td>
                                <td class="fw-500"><span class="badge badge-sm badge-dot badge-warning me-10"></span>{{ $row->tgl_selesai }}</td>
                                <td class="fw-6000">{{ $row->status }}</td>
                            </tr>
                            @endforeach
                            @if($data_pengajuan->isEmpty())
                            <tr>
                                <td colspan="14" class="text-center">Tidak ada data</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
        @endsection