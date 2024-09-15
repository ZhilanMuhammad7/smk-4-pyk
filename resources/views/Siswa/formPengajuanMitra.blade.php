@extends('layouts.master')
@section('content')
<div class="box">
    <div class="box-header with-border">
        <h4 class="box-title">Form Pengajuan Mitra PKL</h4>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col">
                <form action="{{ route('pengajuan.create') }}" method="POST" novalidate>
                    @csrf
                    @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="mitra_id" value="{{ $mitra->id }}">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <h5>Nama <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="nama" class="form-control" value="{{ auth()->user()->name }}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Jurusan <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="jurusan" class="form-control" value="{{ auth()->user()->jurusan }}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Transkrip Nilai <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="file" name="gambar" class="form-control" required>
                                </div>
                                <div class="form-control-feedback"><small>Upload dalam bentuk jpg,png,jpeg <code>max 1MB</code> per file</small></div>
                            </div>
                        </div>
                        <div class="text-xs-right">
                            <button type="submit" class="btn btn-info">Submit</button>
                            <a class="btn btn-danger" href="/mitra">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection