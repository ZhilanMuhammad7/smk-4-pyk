@extends('layouts.master')

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h4 class="box-title">Daftar Ulasan Tempat Kerja Praktik</h4>
    </div>
    <div class="box-body">
        <!-- Tampilkan pesan berhasil atau gagal -->
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Tabel Daftar Ulasan -->
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Nama Tempat Magang</th>
                        <th>Jurusan</th>
                        <th>Ulasan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allData as $data)
                        <tr>
                            @if(isset($data->name))
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->tempat_magang }}</td>
                            @else
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->mitra ? $data->mitra->nama_mitra : 'Tidak ada mitra' }}</td>
                            @endif
                            <td>{{ $data->jurusan }}</td>
                            <td>{{ $data->ulasan ?? 'Belum ada ulasan' }}</td>
                        </tr>
                    @endforeach
                    @if($allData->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Link Kembali -->
        <div class="form-group mt-3">
            <a href="{{ route('layanan-akademik.index') }}" class="btn btn-primary">Kembali ke Halaman Utama</a>
        </div>
    </div>
</div>
@endsection
