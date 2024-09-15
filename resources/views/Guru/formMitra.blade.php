@extends('layouts.master')
@section('content')
<div class="box">
    <div class="box-header with-border">
        <h4 class="box-title">
            @if(isset($tabel))
            Edit Mitra PKL
            @else
            Tambah Mitra PKL
            @endif
        </h4>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col">
                @if(isset($mitra))
                <form action="{{ route('Guru.updateMitra', $mitra->id) }}" method="POST" novalidate>
                    @csrf
                    @method('PUT')
                    @else
                    <form action="{{ route('mitra.store') }}" method="POST" novalidate>
                        @csrf
                        @endif
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <h5>Nama Mitra <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="nama_mitra" class="form-control" value="{{ old('nama_mitra', $mitra->nama_mitra ?? '') }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Jumlah Kuota <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="number" name="jml_kuota" class="form-control" value="{{ old('jml_kuota', $mitra->jml_kuota ?? '') }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Kriteria <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="kriteria" id="textarea" class="form-control" required>{{ old('kriteria', $mitra->kriteria ?? '') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Jurusan <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="jurusan" id="select" class="form-select" required>
                                            <option value="Teknik Komputer Jaringan" @if(old('jurusan', isset($mitra) && $mitra->jurusan == 'Teknik Komputer Jaringan')) selected @endif>Teknik Komputer Jaringan (TKJ)</option>
                                            <option value="Rekayasa Perangkat Lunak" @if(old('jurusan', isset($mitra) && $mitra->jurusan == 'Rekayasa Perangkat Lunak')) selected @endif>Rekayasa Perangkat Lunak (RPL)</option>
                                            <option value="Multimedia" @if(old('jurusan', isset($mitra) && $mitra->jurusan == 'Multimedia')) selected @endif>Multimedia</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Lokasi <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea type="text" name="lokasi" class="form-control" value="{{ old('lokasi', $mitra->lokasi ?? '') }}" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Fasilitas <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea type="text" name="fasilitas" class="form-control" value="{{ old('fasilitas', $mitra->fasilitas ?? '') }}" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Tanggal Mulai <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="tgl_mulai" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Tanggal Selesai <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="tgl_selesai" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-xs-right">
                            @if(isset($mitra))
                            <button type="submit" class="btn btn-info">Simpan Perubahan</button>
                            @else
                            <button type="submit" class="btn btn-primary">Tambah Mitra PKL</button>
                            @endif
                            <a class="btn btn-danger" href="{{ route('Guru.mitraPKL') }}">Kembali</a>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection